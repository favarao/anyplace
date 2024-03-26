<?php 
class Promocao extends Database{
    public $id;
    public $idCliente;
    public $valor;
    public $dataInicial;
    public $dataFinal;
    public $titulo;
    public $status;
    public $nomeCliente;

    public function __construct($data = null){
        $this->id = $data["id"]??0;
        $this->idCliente = $data["idCliente"]??0;
        $this->valor = $data["valor"]??'';
        $this->titulo = $data["titulo"]??'';
        $this->dataInicial = $data["dataInicial"]??'';
        $this->nomeCliente = $data['nomeCliente']??'';
        $this->dataFinal = $data["dataFinal"]??'';
        $this->status = $data["status"]??1;
    }

    public static function getPromocoes($idCliente = ''){
        try{
        $pdo = self::getConnection();
        $select = "SELECT p.*, pe.nome nomeCliente FROM promocao p inner join pessoa pe on pe.id = p.idCliente WHERE p.status!=999";
        if($idCliente)
            $select .= " AND p.idCliente = '$idCliente'";
        $select .= " ORDER BY p.titulo ASC";
        $stm = $pdo->query($select);
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

    public function salvaProdutos($produtos = ''){
        $pdo = self::getConnection();
        $stm = $pdo->query("DELETE FROM promocao_produtos WHERE idPromocao = '$this->id'");
        $produtos = explode(',',$produtos);
        
        foreach ($produtos as $p) {
            if($p)
            $pdo->query("INSERT INTO promocao_produtos(idPromocao,idProduto) VALUES('$this->id','$p')");
        }
    }

    public function getProdutos()
    {
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT p.* FROM produto p inner join promocao_produtos pp on pp.idProduto = p.id WHERE pp.idPromocao = $this->id");
            $produtos = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
                $produtos[] = new Produto($row);
            }
            return $produtos;
            }catch(PDOException $e){
                throw new Exception(print_r($e->errorInfo));
            }
    }


    public function save(){
        if($this->id)
            if(self::update())
                return $this->id;
        return self::insert();        
    }

    public function insert(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("INSERT INTO promocao (idCliente,valor,dataInicial,dataFinal,titulo,status)
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
            $stm = $pdo->query("UPDATE promocao SET
            idCliente = '$this->idCliente',
            valor = '$this->valor',
            dataInicial = '$this->dataInicial',
            dataFinal = '$this->dataFinal',
            titulo = '$this->titulo',
            status = '$this->status'
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