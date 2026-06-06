<?php

require_once '../app/core/Database.php';

class Cliente {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

   public function listar($busca = null){

        if($busca){

            $sql = $this->db->prepare("
                SELECT *
                FROM clientes
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
            FROM clientes
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($dados){

        $sql = $this->db->prepare("
            INSERT INTO clientes
            (
                nome,
                cpf_cnpj,
                contato,
                endereco,
                cidade,
                estado
            )
            VALUES
            (
                :nome,
                :cpf_cnpj,
                :contato,
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
            FROM clientes
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dados){

        $sql = $this->db->prepare("
            UPDATE clientes
            SET
                nome = :nome,
                cpf_cnpj = :cpf_cnpj,
                contato = :contato,
                endereco = :endereco,
                cidade = :cidade,
                estado = :estado
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':cpf_cnpj' => $dados['cpf_cnpj'],
            ':contato' => $dados['contato'],
            ':endereco' => $dados['endereco'],
            ':cidade' => $dados['cidade'],
            ':estado' => $dados['estado']
        ]);
    }

    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM clientes
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }

    public function contar(){
        $sql = $this->db->query("SELECT COUNT(*) as total FROM clientes");

        return $sql->fetch()['total'];
    }
}