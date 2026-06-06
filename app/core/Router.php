<?php

require_once '../app/core/Controller.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/CategoriaController.php';
require_once '../app/controllers/ProdutoController.php';
require_once '../app/controllers/ClienteController.php';
require_once '../app/controllers/FuncionarioController.php';
require_once '../app/controllers/FornecedorController.php';


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

            ///////////////////////// clientes
            case 'clientes':

                $controller = new ClienteController();
                $controller->index();

            break;

            case 'cliente-create':

                $controller = new ClienteController();
                $controller->create();

            break;

            case 'cliente-edit':

                $controller = new ClienteController();
                $controller->edit();

            break;

            case 'cliente-delete':

                $controller = new ClienteController();
                $controller->delete();

            break;

            ///////////////////////// funcionarios
            case 'funcionarios':

                $controller = new FuncionarioController();
                $controller->index();

            break;

            case 'funcionario-create':

                $controller = new FuncionarioController();
                $controller->create();

            break;

            case 'funcionario-edit':

                $controller = new FuncionarioController();
                $controller->edit();

            break;

            case 'funcionario-delete':

                $controller = new FuncionarioController();
                $controller->delete();

            break;
            
            ///////////////////////// fornecedores
            case 'fornecedores':

                $controller = new FornecedorController();
                $controller->index();

            break;

            case 'fornecedor-create':

                $controller = new FornecedorController();
                $controller->create();

            break;

            case 'fornecedor-edit':

                $controller = new FornecedorController();
                $controller->edit();

            break;

            case 'fornecedor-delete':

                $controller = new FornecedorController();
                $controller->delete();

            break;




            
            
            default:
                echo "Página não encontrada";
            break;
        }
    }
}