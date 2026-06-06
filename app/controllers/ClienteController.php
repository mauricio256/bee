<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Cliente.php';

class ClienteController extends Controller {
    public function index(){

        Auth::check();

        $cliente = new Cliente();

        $busca = $_GET['busca'] ?? '';

        $clientes = $cliente->listar($busca);

        require_once '../app/views/clientes/index.php';
    }

    public function create(){

        Auth::check();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $cliente = new Cliente();

            $cliente->cadastrar($_POST);

            header('Location: ?url=clientes');
            exit;
        }

        require_once '../app/views/clientes/create.php';
    }

    public function edit(){

        Auth::check();

        $cliente = new Cliente();

        $id = $_GET['id'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $cliente->atualizar($id, $_POST);

            header('Location: ?url=clientes');
            exit;
        }

        $dados = $cliente->buscarPorId($id);

        require_once '../app/views/clientes/edit.php';
    }

    public function delete(){

        Auth::check();

        $cliente = new Cliente();

        $cliente->deletar($_POST['id']);

        header('Location: ?url=clientes');
        exit;
    }
}