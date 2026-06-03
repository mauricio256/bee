<?php

class Database {

    private static $instance;

    public static function connect(){

        if(!self::$instance){

            self::$instance = new PDO(
                "mysql:host=localhost;dbname=Bee;charset=utf8",
                "root",
                ""
            );

            self::$instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$instance;
    }
}