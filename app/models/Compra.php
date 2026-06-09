<?php

require_once '../app/core/Database.php';

class Compra {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    public function listar(){

        $sql = $this->db->query("
            SELECT
                c.*,
                f.nome AS fornecedor
            FROM compras c
            LEFT JOIN fornecedores f
                ON f.id = c.fornecedor_id
            ORDER BY c.id DESC
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($dados){

        $sql = $this->db->prepare("
            INSERT INTO compras
            (
                fornecedor_id,
                usuario_id,
                total,
                status
            )
            VALUES
            (
                :fornecedor_id,
                :usuario_id,
                :total,
                :status
            )
        ");

        return $sql->execute([

            ':fornecedor_id' => $dados['fornecedor_id'],
            ':usuario_id' => $_SESSION['user']['id'],
            ':total' => 0,
            ':status' => 'pendente'
        ]);
    }

    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM compras
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM compras
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }


    public function listarItens($compraId){

        $sql = $this->db->prepare("
            SELECT
                ci.*,
                p.nome AS produto
            FROM compra_itens ci
            INNER JOIN produtos p
                ON p.id = ci.produto_id
            WHERE ci.compra_id = :compra
        ");

        $sql->execute([
            ':compra' => $compraId
        ]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function adicionarItem($dados){

        $subtotal =
            $dados['quantidade']
            *
            $dados['custo_unitario'];

        $sql = $this->db->prepare("
            INSERT INTO compra_itens
            (
                compra_id,
                produto_id,
                quantidade,
                custo_unitario,
                subtotal
            )
            VALUES
            (
                :compra_id,
                :produto_id,
                :quantidade,
                :custo_unitario,
                :subtotal
            )
        ");

        return $sql->execute([

            ':compra_id' => $dados['compra_id'],
            ':produto_id' => $dados['produto_id'],
            ':quantidade' => $dados['quantidade'],
            ':custo_unitario' => $dados['custo_unitario'],
            ':subtotal' => $subtotal
        ]);
    }

   public function finalizar($id){

        // Verifica se a compra existe
        $compra = $this->buscarPorId($id);

        if(!$compra){
            return false;
        }

        // Não permite finalizar duas vezes
        if($compra['status'] == 'finalizada'){
            return false;
        }

        $this->db->beginTransaction();

        try{

            $sql = $this->db->prepare("
                SELECT *
                FROM compra_itens
                WHERE compra_id = :id
            ");

            $sql->execute([
                ':id' => $id
            ]);

            $itens = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Não permite finalizar compra sem itens
            if(count($itens) == 0){

                $this->db->rollBack();

                return false;
            }

            $total = 0;

            foreach($itens as $item){

                $total += $item['subtotal'];

                // Atualiza custo do produto
                $sqlProduto = $this->db->prepare("
                    UPDATE produtos
                    SET custo = :custo
                    WHERE id = :produto
                ");

                $sqlProduto->execute([

                    ':custo' => $item['custo_unitario'],

                    ':produto' => $item['produto_id']
                ]);

                // Atualiza estoque atual
                $sqlEstoque = $this->db->prepare("
                    UPDATE produtos
                    SET estoque_atual = estoque_atual + :quantidade
                    WHERE id = :produto
                ");

                $sqlEstoque->execute([

                    ':quantidade' => $item['quantidade'],

                    ':produto' => $item['produto_id']
                ]);

                // Gera movimentação de estoque
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
                        'entrada',
                        'compra',
                        :compra,
                        :quantidade,
                        :custo
                    )
                ");

                $sqlMov->execute([

                    ':produto' => $item['produto_id'],

                    ':compra' => $id,

                    ':quantidade' => $item['quantidade'],

                    ':custo' => $item['custo_unitario']
                ]);
            }

            // Atualiza compra
            $sql = $this->db->prepare("
                UPDATE compras
                SET
                    total = :total,
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

            return false;
        }
    }

    public function deletarItem($id){

        $sql = $this->db->prepare("
            DELETE FROM compra_itens
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }
    
}    