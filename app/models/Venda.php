<?php

require_once '../app/core/Database.php';

class Venda {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    // LISTAR VENDAS
    public function listar(){

        $sql = $this->db->query("
            SELECT
                v.*,
                c.nome AS cliente
            FROM vendas v
            LEFT JOIN clientes c
                ON c.id = v.cliente_id
            ORDER BY v.id DESC
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    
    // CRIAR VENDA
    public function cadastrar($dados){

        $sql = $this->db->prepare("
            INSERT INTO vendas
            (
                cliente_id,
                usuario_id,
                subtotal,
                desconto,
                total_final,
                tipo,
                status
            )
            VALUES
            (
                :cliente_id,
                :usuario_id,
                0,
                0,
                0,
                :tipo,
                'aberta'
            )
        ");

        $sql->execute([

            ':cliente_id' => !empty($dados['cliente_id'])
                ? $dados['cliente_id']
                : null,

            ':usuario_id' => $_SESSION['user']['id'],

            ':tipo' => $dados['tipo']
        ]);

        return $this->db->lastInsertId();
    }



    // BUSCAR VENDA
    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM vendas
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // LISTAR ITENS
    public function listarItens($vendaId){

        $sql = $this->db->prepare("
            SELECT
                vi.*,
                p.nome AS produto
            FROM venda_itens vi
            INNER JOIN produtos p
                ON p.id = vi.produto_id
            WHERE vi.venda_id = :venda
        ");

        $sql->execute([
            ':venda' => $vendaId
        ]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // ADICIONAR ITEM
    public function adicionarItem($dados){

        $sqlProduto = $this->db->prepare("
            SELECT preco_venda
            FROM produtos
            WHERE id = :id
        ");

        $sqlProduto->execute([
            ':id' => $dados['produto_id']
        ]);

        $produto = $sqlProduto->fetch(PDO::FETCH_ASSOC);

        $preco = $produto['preco_venda'];

        $subtotal =
            $dados['quantidade']
            * $preco;

        $sql = $this->db->prepare("
            INSERT INTO venda_itens
            (
                venda_id,
                produto_id,
                quantidade,
                preco_unitario,
                subtotal
            )
            VALUES
            (
                :venda,
                :produto,
                :quantidade,
                :preco,
                :subtotal
            )
        ");

        return $sql->execute([

            ':venda' => $dados['venda_id'],

            ':produto' => $dados['produto_id'],

            ':quantidade' => $dados['quantidade'],

            ':preco' => $preco,

            ':subtotal' => $subtotal
        ]);
    }

    // EXCLUIR ITEM
    public function deletarItem($id){

        $sql = $this->db->prepare("
            DELETE FROM venda_itens
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }

    // FINALIZAR VENDA
    public function finalizar($id){

        $venda = $this->buscarPorId($id);

        if(!$venda){
            return false;
        }

        if($venda['status'] == 'finalizada'){
            return false;
        }

        $this->db->beginTransaction();

        try{

            $sql = $this->db->prepare("
                SELECT *
                FROM venda_itens
                WHERE venda_id = :id
            ");

            $sql->execute([
                ':id' => $id
            ]);

            $itens = $sql->fetchAll(PDO::FETCH_ASSOC);

            if(count($itens) == 0){

                $this->db->rollBack();

                return false;
            }

            $total = 0;

            foreach($itens as $item){

                // Busca estoque atual do produto

                $sqlProduto = $this->db->prepare("
                    SELECT
                        nome,
                        estoque_atual
                    FROM produtos
                    WHERE id = :id
                ");

                $sqlProduto->execute([
                    ':id' => $item['produto_id']
                ]);

                $produto = $sqlProduto->fetch(PDO::FETCH_ASSOC);

                // Verifica estoque disponível

                if($produto['estoque_atual'] < $item['quantidade']){

                    throw new Exception(
                        'Estoque insuficiente para o produto: ' .
                        $produto['nome']
                    );
                }

                $total += $item['subtotal'];

                // Baixa estoque

                $sqlEstoque = $this->db->prepare("
                    UPDATE produtos
                    SET estoque_atual = estoque_atual - :quantidade
                    WHERE id = :produto
                ");

                $sqlEstoque->execute([

                    ':quantidade' => $item['quantidade'],

                    ':produto' => $item['produto_id']
                ]);

                // Gera movimentação

                $sqlMov = $this->db->prepare("
                    INSERT INTO estoque_movimentacoes
                    (
                        produto_id,
                        tipo,
                        origem,
                        referencia_id,
                        quantidade,
                        custo_unitario
                    )
                    VALUES
                    (
                        :produto,
                        'saida',
                        'venda',
                        :venda,
                        :quantidade,
                        :valor
                    )
                ");

                $sqlMov->execute([

                    ':produto' => $item['produto_id'],

                    ':venda' => $id,

                    ':quantidade' => $item['quantidade'],

                    ':valor' => $item['preco_unitario']
                ]);
            }

            $sql = $this->db->prepare("
                UPDATE vendas
                SET
                    subtotal = :total,
                    total_final = :total,
                    status = 'finalizada'
                WHERE id = :id
            ");

            $sql->execute([

                ':total' => $total,

                ':id' => $id
            ]);

            $this->db->commit();

            return true;

        }catch(Exception $e){

            $this->db->rollBack();

            $_SESSION['erro'] = $e->getMessage();

            return false;
        }
    }

    public function finalizarPdv($carrinho){

        $this->db->beginTransaction();

        try{

            $total = 0;

            foreach($carrinho as $item){

                $sql = $this->db->prepare("
                    SELECT
                        estoque_atual
                    FROM produtos
                    WHERE id = :id
                ");

                $sql->execute([
                    ':id' => $item['id']
                ]);

                $produto = $sql->fetch(PDO::FETCH_ASSOC);

                if(
                    $produto['estoque_atual']
                    <
                    $item['quantidade']
                ){

                    throw new Exception(
                        'Estoque insuficiente'
                    );
                }

                $total +=
                    $item['quantidade']
                    *
                    $item['preco'];
            }

            // VENDA

            $sql = $this->db->prepare("
                INSERT INTO vendas
                (
                    cliente_id,
                    usuario_id,
                    subtotal,
                    desconto,
                    total_final,
                    tipo,
                    status
                )
                VALUES
                (
                    NULL,
                    :usuario,
                    :total,
                    0,
                    :total,
                    'avista',
                    'finalizada'
                )
            ");

            $sql->execute([

                ':usuario' =>
                    $_SESSION['user']['id'],

                ':total' => $total
            ]);

            $vendaId =
                $this->db->lastInsertId();

            foreach($carrinho as $item){

                $subtotal =
                    $item['quantidade']
                    *
                    $item['preco'];

                // ITEM

                $sqlItem = $this->db->prepare("
                    INSERT INTO venda_itens
                    (
                        venda_id,
                        produto_id,
                        quantidade,
                        preco_unitario,
                        subtotal
                    )
                    VALUES
                    (
                        :venda,
                        :produto,
                        :quantidade,
                        :preco,
                        :subtotal
                    )
                ");

                $sqlItem->execute([

                    ':venda' => $vendaId,

                    ':produto' => $item['id'],

                    ':quantidade' =>
                        $item['quantidade'],

                    ':preco' =>
                        $item['preco'],

                    ':subtotal' =>
                        $subtotal
                ]);

                // ESTOQUE

                $sqlEstoque =
                    $this->db->prepare("
                        UPDATE produtos
                        SET estoque_atual =
                            estoque_atual
                            - :quantidade
                        WHERE id = :id
                    ");

                $sqlEstoque->execute([

                    ':quantidade' =>
                        $item['quantidade'],

                    ':id' => $item['id']
                ]);

                // MOVIMENTAÇÃO

                $sqlMov =
                    $this->db->prepare("
                        INSERT INTO
                        estoque_movimentacoes
                        (
                            produto_id,
                            tipo,
                            origem,
                            referencia_id,
                            quantidade,
                            custo_unitario
                        )
                        VALUES
                        (
                            :produto,
                            'saida',
                            'venda',
                            :venda,
                            :quantidade,
                            :valor
                        )
                    ");

                $sqlMov->execute([

                    ':produto' =>
                        $item['id'],

                    ':venda' =>
                        $vendaId,

                    ':quantidade' =>
                        $item['quantidade'],

                    ':valor' =>
                        $item['preco']
                ]);
            }

            $this->db->commit();

            return true;

        }catch(Exception $e){

            $this->db->rollBack();

            $_SESSION['erro'] =
                $e->getMessage();

            return false;
        }
    }
}