<?php
class Configuracao extends Database
{
    public $id;
    public $nomeSistema;
    public $logo;
    public $nomeAdministrador;

    public static function getConfiguracao(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT * from configuracao where id=1");
            return $stm->fetchAll(PDO::FETCH_CLASS,'Cliente');
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
    
}