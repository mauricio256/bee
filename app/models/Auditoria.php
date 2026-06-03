<?php

require_once '../app/core/Database.php';

class Auditoria {

    private $db;

    public function __construct(){

        $this->db = Database::connect();
    }

    public function registrar(
        $tabela,
        $registro_id,
        $acao,
        $dados_antes,
        $usuario_id
    ){

        $sql = $this->db->prepare("
            INSERT INTO auditoria
            (
                tabela,
                registro_id,
                acao,
                dados_antes,
                usuario_id
            )
            VALUES
            (
                :tabela,
                :registro_id,
                :acao,
                :dados_antes,
                :usuario_id
            )
        ");

        return $sql->execute([
            ':tabela' => $tabela,
            ':registro_id' => $registro_id,
            ':acao' => $acao,
            ':dados_antes' => json_encode($dados_antes),
            ':usuario_id' => $usuario_id
        ]);
    }

    public function ultimasOperacoes($tabela){

        $sql = $this->db->prepare("
            SELECT
                a.*,
                u.nome AS usuario
            FROM auditoria a
            LEFT JOIN users u
                ON u.id = a.usuario_id
            WHERE a.tabela = :tabela
            ORDER BY a.id DESC
            LIMIT 50
        ");

        $sql->execute([
            ':tabela' => $tabela
        ]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}