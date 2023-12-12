<?php 
class Cliente extends Database{
    public function __construct(){}

    public static function getClientes(){
        try{
        $pdo = self::getConnection();
        $stm = $pdo->query("SELECT p.* FROM pessoa p WHERE p.status!=999");
        // $clientes = array();
        // while($row = $stm->fetchObject('Cliente'))
        //     $clientes[] = $row;
        // return $clientes;
        return $stm->fetchAll(PDO::FETCH_CLASS,'Cliente');
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }

    }
}