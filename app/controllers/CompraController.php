<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Compra.php';
require_once '../app/models/Fornecedor.php';

class CompraController extends Controller {

    public function index(){

        Auth::check();

        $compra = new Compra();

        $compras = $compra->listar();

        require_once '../app/views/compras/index.php';
    }

    public function create(){

        Auth::check();

        $fornecedor = new Fornecedor();

        $fornecedores = $fornecedor->listar();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $compra = new Compra();

            $compra->cadastrar($_POST);

            header('Location: ?url=compras');
            exit;
        }

        require_once '../app/views/compras/create.php';
    }

    public function delete(){

        Auth::check();

        $compra = new Compra();

        $compra->deletar($_POST['id']);

        header('Location: ?url=compras');
        exit;
    }

    public function itens(){

        Auth::check();

        $id = $_GET['id'];

        $compra = new Compra();

        $dados = $compra->buscarPorId($id);

        $itens = $compra->listarItens($id);

        $produto = new Produto();

        $produtos = $produto->listar();

        require_once '../app/views/compras/itens.php';
    }

    public function adicionarItem(){

        Auth::check();

        $compra = new Compra();

        $compra->adicionarItem($_POST);

        header(
            'Location: ?url=compra-itens&id=' .
            $_POST['compra_id']
        );

        exit;
    }

    public function finalizar(){

        Auth::check();

        $compra = new Compra();

        $compra->finalizar($_POST['id']);

        header('Location: ?url=compras');

        exit;
    }

    public function deleteItem(){

        Auth::check();

        $compraId = $_POST['compra_id'];

        $compra = new Compra();

        $compra->deletarItem($_POST['id']);

        header(
            'Location: ?url=compra-itens&id=' . $compraId
        );

        exit;
    }

    
}