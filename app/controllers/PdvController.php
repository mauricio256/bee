<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Venda.php';
require_once '../app/models/Produto.php';

class PdvController extends Controller {

    public function index(){

        Auth::check();

        if(!isset($_SESSION['carrinho'])){

            $_SESSION['carrinho'] = [];
        }

        require_once '../app/views/pdv/index.php';
    }

    public function add(){

        Auth::check();

        $codigo = $_POST['codigo'];

        $produtoModel = new Produto();

        $produto = $produtoModel->buscarPorCodigo($codigo);

        if(!$produto){

            $_SESSION['erro'] = 'Produto não encontrado';

            header('Location: ?url=pdv');
            exit;
        }

        if(isset($_SESSION['carrinho'][$produto['id']])){

            $_SESSION['carrinho'][$produto['id']]['quantidade']++;

        }else{

            $_SESSION['carrinho'][$produto['id']] = [

                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco_venda'],
                'quantidade' => 1
            ];
        }

        header('Location: ?url=pdv');
        exit;
    }

    public function remove(){

        Auth::check();

        $id = $_GET['id'];

        if(isset($_SESSION['carrinho'][$id])){

            unset($_SESSION['carrinho'][$id]);
        }

        header('Location: ?url=pdv');
        exit;
    }

    public function clear(){

        Auth::check();

        $_SESSION['carrinho'] = [];

        header('Location: ?url=pdv');
        exit;
    }


    public function finalizar(){

        Auth::check();

        if(empty($_SESSION['carrinho'])){

            $_SESSION['erro'] = 'Carrinho vazio';

            header('Location: ?url=pdv');
            exit;
        }

        $venda = new Venda();

        $resultado = $venda->finalizarPdv(
            $_SESSION['carrinho']
        );

        if($resultado){

            $_SESSION['carrinho'] = [];

            $_SESSION['sucesso'] =
                'Venda realizada com sucesso';
        }

        header('Location: ?url=pdv');
        exit;
    }


}