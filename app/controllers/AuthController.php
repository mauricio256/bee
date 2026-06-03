<?php

require_once '../app/core/Controller.php';
require_once '../app/core/Auth.php';
require_once '../app/models/User.php';

class AuthController extends Controller {

    // MOSTRA LOGIN E PROCESSA LOGIN
    public function login(){
        
        // SE FOR POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){  

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $userModel = new User();

            $user = $userModel->buscarPorEmail($email);

            // VERIFICA SE USUÁRIO EXISTE
            if($user){

                // VERIFICA SENHA
                if(password_verify($senha, $user['senha'])){

                    // CRIA SESSÃO
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'nome' => $user['nome'],
                        'nivel' => $user['nivel']
                    ];

                    // REDIRECIONA
                    $this->redirect('?url=dashboard');
                    exit;

                } else {
                    $_SESSION['msg'] = "Senha inválida";
                    $this->redirect('?url=login');
                    exit;
                }

            } else {
                $_SESSION['msg'] = "Usuário inválido";
                $this->redirect('?url=login');
                exit;
            }

        } else { 

            $this->view('login');
        
        }
    }

    // ÁREA LOGADA
    public function dashboard(){

        // VERIFICA SE LOGIN FOI FEITO chamando a funcao que esta em Auth.php na pasta core uma funcao estatica
        Auth::check();

        // ABRE VIEW
        $this->view('dashboard');
    }

    // LOGOUT
    public function logout(){

        session_destroy();
        $this->redirect('?url=login');
        exit;
    }

}