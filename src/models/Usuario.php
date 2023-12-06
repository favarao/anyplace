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
    
}