<?php

require_once '../app/core/Database.php';

class User {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    // LOGIN
    public function buscarPorEmail($email){

        $sql = $this->db->prepare("
            SELECT *
            FROM users
            WHERE email = :email
        ");

        $sql->execute([
            ':email' => $email
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // LISTAR
    public function listar($busca = null){

        if($busca){

            $sql = $this->db->prepare("
                SELECT *
                FROM users
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
            FROM users
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // CADASTRAR
    public function cadastrar($dados){

        $sql = $this->db->prepare("
            INSERT INTO users
            (
                nome,
                email,
                senha,
                telefone,
                nivel,
                ativo
            )
            VALUES
            (
                :nome,
                :email,
                :senha,
                :telefone,
                :nivel,
                :ativo
            )
        ");

        return $sql->execute([

            ':nome' => $dados['nome'],

            ':email' => $dados['email'],

            ':senha' => password_hash(
                $dados['senha'],
                PASSWORD_DEFAULT
            ),

            ':telefone' => $dados['telefone'],

            ':nivel' => $dados['nivel'],

            ':ativo' => $dados['ativo']
        ]);
    }

    // BUSCAR POR ID
    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM users
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // ATUALIZAR
    public function atualizar($id, $dados){

        $sql = $this->db->prepare("
            UPDATE users
            SET
                nome = :nome,
                email = :email,
                telefone = :telefone,
                nivel = :nivel,
                ativo = :ativo
            WHERE id = :id
        ");

        return $sql->execute([

            ':id' => $id,

            ':nome' => $dados['nome'],

            ':email' => $dados['email'],

            ':telefone' => $dados['telefone'],

            ':nivel' => $dados['nivel'],

            ':ativo' => $dados['ativo']
        ]);
    }

    // EXCLUIR
    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM users
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }

    // ALTERAR SENHA
    public function alterarSenha($id, $senha){

        $sql = $this->db->prepare("
            UPDATE users
            SET senha = :senha
            WHERE id = :id
        ");

        return $sql->execute([

            ':id' => $id,

            ':senha' => password_hash(
                $senha,
                PASSWORD_DEFAULT
            )
        ]);
    }
}