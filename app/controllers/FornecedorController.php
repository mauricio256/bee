<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Fornecedores.php';

class FornecedorController extends Controller {

    public function index(){

        Auth::check();

        $fornecedor = new Fornecedor();

        $busca = $_GET['busca'] ?? '';

        $fornecedores = $fornecedor->listar($busca);

        require_once '../app/views/fornecedores/index.php';
    }

    public function create(){

        Auth::check();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $fornecedor = new Fornecedor();

            $fornecedor->cadastrar($_POST);

            header('Location: ?url=fornecedores');
            exit;
        }

        require_once '../app/views/fornecedores/create.php';
    }

    public function edit(){

        Auth::check();

        $fornecedor = new Fornecedor();

        $id = $_GET['id'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $fornecedor->atualizar($id, $_POST);

            header('Location: ?url=fornecedores');
            exit;
        }

        $dados = $fornecedor->buscarPorId($id);

        require_once '../app/views/fornecedores/edit.php';
    }

    public function delete(){

        Auth::check();

        $fornecedor = new Fornecedor();

        $fornecedor->deletar($_POST['id']);

        header('Location: ?url=fornecedores');
        exit;
    }
}