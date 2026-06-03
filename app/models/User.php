<?php

require_once '../app/core/Database.php';

class User {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    public function buscarPorEmail($email){

        $sql = $this->db->prepare("
            SELECT * FROM users
            WHERE email = :email
        ");

        $sql->bindValue(':email', $email);

        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}