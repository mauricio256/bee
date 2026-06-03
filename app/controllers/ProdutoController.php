<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Produto.php';
require_once '../app/models/Categoria.php';

class ProdutoController extends Controller {

    public function index(){

        Auth::check();

        $produto = new Produto();

        $produtos = $produto->listar();

        require_once '../app/views/produtos/index.php';
    }

    public function create(){

        Auth::check();

        $categoria = new Categoria();

        $categorias = $categoria->todas();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $produto = new Produto();

            $produto->cadastrar($_POST);

            header('Location: ?url=produtos');
            exit;
        }

        require_once '../app/views/produtos/create.php';
    }

    public function edit(){

        Auth::check();

        $produto = new Produto();

        $categoria = new Categoria();

        $categorias = $categoria->todas();

        $id = $_GET['id'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $produto->atualizar($id, $_POST);

            header('Location: ?url=produtos');
            exit;
        }

        $dados = $produto->buscarPorId($id);

        require_once '../app/views/produtos/edit.php';
    }


    public function delete(){

        Auth::check();

        $id = $_POST['id'];

        $produto = new Produto();

        $produto->deletar($id);

        header('Location: ?url=produtos');
        exit;
    }
}