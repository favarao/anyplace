<?php
class Configuracao extends Database
{
    public $id;
    public $nomeSistema;
    public $logo;
    public $nomeAdministrador;

    public function __construct($data){
        $this->id = $data["id"]??'';
        $this->nomeSistema = $data["nomeSistema"]??'';
        $this->nomeAdministrador = $data["nomeAdministrador"]??'';
        $this->logo = $data["logo"]??'';
    }
    public static function getConfiguracao(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT * from configuracao where id=1");
            return new Configuracao($stm->fetch(PDO::FETCH_ASSOC));
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public function update(){
        try{
            $pdo = self::getConnection();
            $sql = "UPDATE configuracao SET
            nomeSistema = '$this->nomeSistema',
            nomeAdministrador = '$this->nomeAdministrador'";
            if($this->logo)
            $sql.= ",logo = '$this->logo'";
            
            $sql .= "where id='1'";
            $stm = $pdo->query($sql);
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
    
}