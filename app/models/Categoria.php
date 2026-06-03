<?php

require_once '../app/core/Database.php';

class Categoria {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    public function listar(){

        $sql = $this->db->query("
            SELECT *
            FROM categorias
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome){

        $sql = $this->db->prepare("
            INSERT INTO categorias(nome)
            VALUES(:nome)
        ");

        return $sql->execute([
            ':nome' => $nome
        ]);
    }

    public function deletar($id){

        $sql = $this->db->prepare("
            DELETE FROM categorias
            WHERE id = :id
        ");

        return $sql->execute([
            ':id' => $id
        ]);
    }

    public function buscarPorId($id){

        $sql = $this->db->prepare("
            SELECT *
            FROM categorias
            WHERE id = :id
        ");

        $sql->execute([
            ':id' => $id
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function todas(){

        $sql = $this->db->query("
            SELECT *
            FROM categorias
            ORDER BY nome
        ");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}