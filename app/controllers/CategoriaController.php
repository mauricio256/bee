<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/Categoria.php';
require_once '../app/models/Auditoria.php';

class CategoriaController extends Controller {

    public function index(){

        Auth::check();

        $categoria = new Categoria();

        $categorias = $categoria->listar();

        require_once '../app/views/categorias/index.php';
    }

    public function create(){

        Auth::check();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $nome = $_POST['nome'];

            $categoria = new Categoria();

            $categoria->cadastrar($nome);

            header('Location: ?url=categorias');
            exit;
        }

        $this->view('categorias/create');
    }

    public function delete(){

        Auth::check();

        if($_SERVER['REQUEST_METHOD'] != 'POST'){

            die('Método inválido');
        }

        $id = $_POST['id'] ?? 0;

        $categoria = new Categoria();

        $dados = $categoria->buscarPorId($id);

        if(!$dados){

            die('Categoria não encontrada');
        }

        $auditoria = new Auditoria();

        $auditoria->registrar(
            'categorias',
            $id,
            'delete',
            $dados,
            $_SESSION['user']['id']
        );

        $categoria->deletar($id);

        $_SESSION['msg'] = 'Categoria excluída com sucesso';

        header('Location: ?url=categorias');
        exit;
    }

    public function historico(){

        Auth::check();

        $auditoria = new Auditoria();

        $logs = $auditoria->ultimasOperacoes('categorias');

        require_once '../app/views/categorias/historico.php';
    }
}