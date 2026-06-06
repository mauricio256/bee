<?php

require_once '../app/core/Database.php';

class Produto {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

   public function listar($busca = null){

        $sql = "
            SELECT
                p.*,
                c.nome AS categoria
            FROM produtos p
            LEFT JOIN categorias c
                ON c.id = p.categoria_id
        ";

        if($busca){
            $sql .= " WHERE p.nome LIKE :busca ";
        }

        $sql .= " ORDER BY p.nome ";

        $stmt = $this->db->prepare($sql);

        if($busca){
            $stmt->bindValue(':busca', "%{$busca}%");
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cadastrar($dados){

        $margem = (
        ($dados['preco_venda'] - $dados['custo'])
            /
            $dados['custo']
        ) * 100;

        $sql = $this->db->prepare("
            INSERT INTO produtos
            (
                nome,
                codigo_barras,
                categoria_id,
                preco_venda,
                custo,
                margem_lucro,
                estoque_minimo
            )
            VALUES
            (
                :nome,
                :codigo_barras,
                :categoria_id,
                :preco_venda,
                :custo,
                :margem_lucro,
                :estoque_minimo
            )
        ");

       return $sql->execute([

            ':nome' => $dados['nome'],

            ':codigo_barras' => $dados['codigo_barras'],

            ':categoria_id' => $dados['categoria_id'],

            ':preco_venda' => $dados['preco_venda'],

            ':custo' => $dados['custo'],

            ':margem_lucro' => $margem,

            ':estoque_minimo' => $dados['estoque_minimo']
        ]);
                
    }

    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM produtos
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    

    public function atualizar($id, $dados){

    $margem = (
        ($dados['preco_venda'] - $dados['custo'])
        / $dados['custo']
    ) * 100;

    $sql = $this->db->prepare("
        UPDATE produtos
        SET
            nome = :nome,
            codigo_barras = :codigo_barras,
            categoria_id = :categoria_id,
            custo = :custo,
            preco_venda = :preco_venda,
            margem_lucro = :margem_lucro,
            estoque_minimo = :estoque_minimo
        WHERE id = :id
    ");

    return $sql->execute([

            ':id' => $id,

            ':nome' => $dados['nome'],

            ':codigo_barras' => $dados['codigo_barras'],

            ':categoria_id' => $dados['categoria_id'],

            ':custo' => $dados['custo'],

            ':preco_venda' => $dados['preco_venda'],

            ':margem_lucro' => $margem,

            ':estoque_minimo' => $dados['estoque_minimo']
        ]);
    }

    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM produtos
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }

    public function todas(){

        $sql = $this->db->query("
            SELECT *
            FROM categorias
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contar(){
        $sql = $this->db->query("SELECT COUNT(*) as total FROM produtos");

        return $sql->fetch()['total'];
    }

}