<?php 
class LoginController extends RenderView
{
    public function __construct() {
    }
    public function index(){
        $this->loadView('login',['titulo' => 'AnyPlace - Login']);
    }

    public function logar(){
        
        $login = $this->getRequest('usuario');
        $senha = md5($this->getRequest('senha'));
        $usuario = Usuario::autenticaLogin($login,$senha);
        if($usuario)
        {
            session_start();
            $_SESSION['idUsuario'] = $usuario->id;
            $_SESSION['nome'] = $usuario->nome??'';
            $_SESSION['grupo'] = $usuario->grupo;
            echo 1;
        }
        else
        {
            echo 0;
        }
        exit;
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
    }
}