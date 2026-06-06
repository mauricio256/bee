<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/User.php';

class FuncionarioController extends Controller {

    public function index(){

        Auth::check();

        $funcionario = new User();

        $busca = $_GET['busca'] ?? '';

        $funcionarios = $funcionario->listar($busca);

        require_once '../app/views/funcionarios/index.php';
    }

    public function create(){

        Auth::check();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $funcionario = new User();

            $funcionario->cadastrar($_POST);

            header('Location: ?url=funcionarios');
            exit;
        }

        require_once '../app/views/funcionarios/create.php';
    }

    public function edit(){

        Auth::check();

        $funcionario = new User();

        $id = $_GET['id'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $funcionario->atualizar($id, $_POST);

            header('Location: ?url=funcionarios');
            exit;
        }

        $dados = $funcionario->buscarPorId($id);

        require_once '../app/views/funcionarios/edit.php';
    }

    public function delete(){

        Auth::check();

        $funcionario = new User();

        $funcionario->deletar($_POST['id']);

        header('Location: ?url=funcionarios');
        exit;
    }
}