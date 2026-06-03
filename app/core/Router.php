<?php

require_once '../app/core/Controller.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/CategoriaController.php';
require_once '../app/controllers/ProdutoController.php';


class Router {

    public function run(){

        $url = $_GET['url'] ?? 'login';

    

        switch($url){

            ////////////////////////// autenticacao
            case 'login': 
                
                $controller = new AuthController();
                
                $controller->login();

            break;

            case 'logout':
                $controller = new AuthController();
                
                $controller->logout();

            break;

            case 'dashboard':

                $controller = new AuthController();

                $controller->dashboard();

            break;



            ///////////////////////// categoria
            case 'categorias':

                $controller = new CategoriaController();

                $controller->index();

            break;

            case 'categoria-create':

                $controller = new CategoriaController();

                $controller->create();

            break;

            case 'categoria-delete':

                $controller = new CategoriaController();

                $controller->delete();

            break;

            case 'categoria-historico':

                $controller = new CategoriaController();

                $controller->historico();

            break;

            ///////////////////// produtos
            case 'produtos':

                $controller = new ProdutoController();

                $controller->index();

            break;

            case 'produto-create':

                $controller = new ProdutoController();

                $controller->create();

            break;

            case 'produto-edit':

                $controller = new ProdutoController();

                $controller->edit();

            break;

            case 'produto-delete':

                $controller = new ProdutoController();

                $controller->delete();

            break;
            
            default:
                echo "Página não encontrada";
            break;
        }
    }
}