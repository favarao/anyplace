<?php 
class LoginController extends RenderView
{
    public function __construct() {
    }
    public function index(){
        $this->loadView('login',['titulo' => 'Login',
    'param' => Configuracao::getConfiguracao()]);
    }

    public function logar(){
        header('Content-Type: application/json');
        $login = $this->getRequest('usuario');
        $senha = md5($this->getRequest('senha'));
        $usuario = Usuario::autenticaLogin($login,$senha);
        if($usuario)
        {
            if($usuario->status=='999')
            {
                echo json_encode(['success' => false,'msg'=>'Usuário inativo']);
            }
            else
            {
                $_SESSION['idUsuario'] = $usuario->id;
                $_SESSION['idCliente'] = $usuario->idCliente;
                $_SESSION['nome'] = $usuario->nome??'';
                $_SESSION['grupo'] = $usuario->grupo;
                
                if($usuario->senha=='202cb962ac59075b964b07152d234b70')
                    $_SESSION['alterar'] = true;
                echo json_encode(['success' => true,'msg'=>'Sucesso ao entrar na conta']);
            }
           
        }
        else
        {
            echo json_encode(['success'=> false, 'msg'=>'Usuário ou senha inválidos']);
        }
        exit;
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        $this->loadView("login",
        [
            'titulo'=>'AnyPlace - Login',
            'param' => Configuracao::getConfiguracao()
        ]);
    }
}