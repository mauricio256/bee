<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';

require_once '../app/models/Venda.php';
require_once '../app/models/Cliente.php';
require_once '../app/models/Produto.php';

class VendaController extends Controller {

    // LISTAGEM
    public function index(){

        Auth::check();

        $venda = new Venda();

        $vendas = $venda->listar();

        require_once '../app/views/vendas/index.php';
    }

    // NOVA VENDA
    public function create(){

        Auth::check();

        $cliente = new Cliente();

        $clientes = $cliente->listar();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $venda = new Venda();

            $id = $venda->cadastrar($_POST);

            header(
                'Location: ?url=venda-itens&id=' . $id
            );

            exit;
        }

        require_once '../app/views/vendas/create.php';
    }

    // TELA DE ITENS
    public function itens(){

        Auth::check();

        $id = $_GET['id'];

        $venda = new Venda();

        $dados = $venda->buscarPorId($id);

        $itens = $venda->listarItens($id);

        $produto = new Produto();

        $produtos = $produto->listar();

        require_once '../app/views/vendas/itens.php';
    }

    // ADICIONAR ITEM
    public function adicionarItem(){

        Auth::check();

        $venda = new Venda();

        $venda->adicionarItem($_POST);

        header(
            'Location: ?url=venda-itens&id=' .
            $_POST['venda_id']
        );

        exit;
    }

    // EXCLUIR ITEM
    public function deleteItem(){

        Auth::check();

        $venda = new Venda();

        $venda->deletarItem($_POST['id']);

        header(
            'Location: ?url=venda-itens&id=' .
            $_POST['venda_id']
        );

        exit;
    }

    // FINALIZAR
    public function finalizar(){

        Auth::check();

        $venda = new Venda();

        $venda->finalizar($_POST['id']);

        header('Location: ?url=vendas');

        exit;
    }
}