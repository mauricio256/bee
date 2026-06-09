<?php

require_once '../app/core/Database.php';

class Fornecedor {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    public function listar($busca = null){

        if($busca){

            $sql = $this->db->prepare("
                SELECT *
                FROM fornecedores
                WHERE nome LIKE :busca
                ORDER BY nome
            ");

            $sql->execute([
                ':busca' => "%{$busca}%"
            ]);

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $sql = $this->db->query("
            SELECT *
            FROM fornecedores
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($dados){

        $sql = $this->db->prepare("
            INSERT INTO fornecedores
            (
                nome,
                cnpj,
                contato,
                telefone,
                endereco,
                cidade,
                estado
            )
            VALUES
            (
                :nome,
                :cnpj,
                :contato,
                :telefone,
                :endereco,
                :cidade,
                :estado
            )
        ");

        return $sql->execute($dados);
    }

    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM fornecedores
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dados){

        $sql = $this->db->prepare("
            UPDATE fornecedores
            SET
                nome = :nome,
                cnpj = :cnpj,
                contato = :contato,
                telefone = :telefone,
                endereco = :endereco,
                cidade = :cidade,
                estado = :estado
            WHERE id = :id
        ");

        $dados['id'] = $id;

        return $sql->execute($dados);
    }

    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM fornecedores
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }
}