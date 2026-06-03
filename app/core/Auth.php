<?php

class Auth {

    public static function check(){

        if(!isset($_SESSION['user'])){

            $_SESSION['msg'] = 'Faça login para continuar';
            header('Location: ?url=login');
            exit;
        }
    }
}