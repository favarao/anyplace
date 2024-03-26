<?php 
class Promocao extends Database{
    public $id;
    public $idCliente;
    public $valor;
    public $dataInicial;
    public $dataFinal;
    public $titulo;
    public $produtos;
    public $status;

    public function __construct($data = null){
        $this->id = $data["id"]??0;
        $this->idCliente = $data["idCliente"]??0;
        $this->valor = $data["valor"]??'';
        $this->titulo = $data["titulo"]??'';
        $this->nomeCliente = $data["nomeCliente"]??'';
        $this->dataInicial = $data["dataInicial"]??'';
        $this->dataFinal = $data["dataFinal"]??'';
        $this->data = $data["titulo"]??'';
        $this->status = $data["status"]??'';
        $this->produtos = ($data['id']??'')?Produto::getPromocaoProdutos($data['id']):'';
    }

    public static function getPromocoes($idCliente = ''){
        try{
        $pdo = self::getConnection();
        $stm = $pdo->query("SELECT p.*, pe.nome nomeCliente FROM promocao p inner join pessoa pe on pe.id = p.idCliente WHERE p.status!=999 ORDER BY p.titulo ASC");
        $promocoes = array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $promocoes[] = new Promocao($row);
        }
        return $promocoes;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getPromocao($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT p.*, pe.nome nomeCliente FROM promocao p inner join pessoa pe on pe.id = p.idCliente WHERE p.status!=999 AND p.id = '$id'");
            $rs = $stm->fetch(PDO::FETCH_ASSOC);
            if($rs)
                return new Promocao($rs);
            return false;
            }catch(PDOException $e){
                throw new Exception(print_r($e->errorInfo));
            }
    }


    public function save(){
        if($this->id)
            return self::update();
        return self::insert();        
    }

    public function insert(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("INSERT INTO promocao (idCliete,valor,dataInicial,dataFinal,titulo,status)
            VALUES(
                '$this->idCliente',
                '$this->valor',
                '$this->dataInicial',
                '$this->dataFinal',
                '$this->titulo',
                '$this->status'
                )");
            if($stm)
                return $pdo->lastInsertId();
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function insertProduto($idPromocao, $idProduto){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("INSERT INTO promocao_produtos (idPromocao,idProduto)
            VALUES('$idPromocao','$idProduto')");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function deleteProduto($idPromocao,$idProduto){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("DELETE FROM promocao_produtos where idPromocao = '$idPromocao' AND idProduto = '$idPrduto'");
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
            $stm = $pdo->query("UPDATE pessoa SET
            idCliete = '$this->nome',
            valor = '$this->loja',
            dataInicial = '$this->cnpj',
            dataFinal = '$this->email',
            titulo = '$this->telefone',
            status = '$this->celular'
            WHERE id = '$this->id'
            ");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public function delete(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE promocao set status = '999' where id = '$this->id'");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
}