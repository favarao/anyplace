<?php
class Usuario extends Database
{
    public $id;
    public $login;
    public $senha;
    public $grupo;
    public $idCliente;

    public function __construct()
    {
        
    }

    public static function autenticaLogin($usuario,$senha){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT u.* FROM usuario u LEFT JOIN pessoa p on p.id = u.idCliente WHERE u.login = '$usuario' AND u.senha = '$senha'");
            return $stm->fetchObject('Usuario');
            }catch(PDOException $e){
                throw new Exception(print_r($e->errorInfo));
            }
    }

    public static function novaSenha($idUsuario,$senha,$senha2){
        $msg = '';
        if($senha!=$senha2)
            $msg .= "Senhas não são iguais<br>";
        if(strlen($senha)<6)
            $msg .= "Tamanho mínimo de 6 caracteres<br>";
        if($senha=='123')
            $msg .= "Senha não pode ser igual a senha inicial<br>";
        if($msg==''){
            try{
                $senha = md5($senha);
                $pdo = self::getConnection();
                $stm = $pdo->query("UPDATE usuario SET senha = '$senha' where id = '$idUsuario'");
                return ['success' => true, 'msg'=>'Sucesso ao ao alterar senha'];
            }catch(PDOException$e){
                return ['success' => false,'msg'=> 'Erro ao alterar senha'];
            }
        }
        else
        {
            return ['success'=> false,'msg'=> $msg];
        }
    }
    
}