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

    public static function getComissao($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT * FROM configuracaonegociacao where idPessoa = $id");
            return $stm->fetch(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            throw new Exception(print_r(e->errorInfo));
        }
    }

    public static function atualizaComissao($data){
        $data = json_decode(json_encode($data));
        if(self::getComissao($data->idPessoa))
            return self::updateComissao($data);
        return self::insertComissao($data);            
    }

    public static function updateComissao($data){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE configuracaonegociacao SET valor = '$data->novoValor', tipo = '$data->novoTipo', dataInicial = '$data->novoInicio', dataFinal = '$data->novoFinal' where idPessoa = $data->idPessoa");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function solicitaComissao($data){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE configuracaonegociacao SET novoValor = '$data->novoValor', novoTipo = '$data->novoTipo', novoFinal = '$data->novoFinal', novoInicio = '$data->novoInicio' WHERE idPessoa = $data->idPessoa");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function insertComissao($data){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("INSERT INTO configuracaonegociacao (idPessoa,valor,tipo,datainicial,datafinal) VALUES('$data->idPessoa','$data->novoValor','$data->novoTipo','$data->dataInicial','$data->dataFinal')");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function alertaNegociacao(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT * FROM configuracaonegociacao WHERE novoValor is not null OR novoTipo is not null or novoFinal is not null or novoInicio is not null");

            $clientes = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
                $clientes[] = new Cliente($row);
            }
        return $clientes;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getClientesNegociacao(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT p.nome, cn.* FROM pessoa p INNER JOIN configuracaonegociacao cn on cn.idPessoa = p.id WHERE p.status!=999 ORDER BY p.nome ASC");
            $clientes = array();
            while($row = $stm->fetch(PDO::FETCH_OBJ)){
                $clientes[] = $row;
            }
        return $clientes;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function recusarNegociacao($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE configuracaonegociacao SET novoValor = NULL, novoTipo = NULL, novoFinal = NULL, novoInicio = NULL WHERE idPessoa = $id");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function aceitarNegociacao($id){
        $comissao = self::getComissao($id);
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE configuracaonegociacao SET valor = '$comissao->novoValor', tipo = '$comissao->novoTipo', dataInicial = '$comissao->novoInicio', dataFinal = '$comissao->novoFinal', novoValor = NULL, novoTipo = NULL, novoInicio = NULL, novoFinal = NULL WHERE idPessoa = $id");
            if($stm)
                return true;
            return false;
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