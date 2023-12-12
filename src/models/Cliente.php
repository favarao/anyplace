<?php 
class Cliente extends Database{
    public function __construct(){}

    public static function getClientes(){
        try{
        $pdo = self::getConnection();
        $stm = $pdo->query("SELECT p.* FROM pessoa p WHERE p.status!=999");
        return $stm->fetchObject('Cliente');
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }

    }
}