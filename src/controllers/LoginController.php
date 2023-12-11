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
            $_SESSION['idUsuario'] = $usuario->id;
            $_SESSION['nome'] = $usuario->nome??'';
            $_SESSION['grupo'] = $usuario->grupo;
            if($usuario->senha=='202cb962ac59075b964b07152d234b70')
                $_SESSION['alterar'] = true;
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
        $this->loadView("login",['titulo'=>'AnyPlace - Login']);
    }
}