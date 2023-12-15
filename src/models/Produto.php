<?php 
class Produto extends Database
{
    public $id;
    public $idCliente;
    public $nomeCliente;
    public $idCategoria;
    public $idMarca;
    public $nome;
    public $sku;
    public $valor;
    public $estoque;
    public $peso;
    public $descricao;
    public $descricaoResumida;
    public $status;
    public $foto1;
    public $foto2;
    public $foto3;

    public function __construct($data){
        $this->id = $data["id"]??0;
        $this->nome = $data["nome"]??'';
        $this->idCliente = $data["idCliente"]??0;
        $this->idCategoria = $data["idCategoria"]??0;
        $this->idMarca = $data["idMarca"]??0;
        $this->nomeCliente = $data["nomeCliente"]??'';
        $this->loja = $data["loja"]??'';
        $this->sku = $data["sku"]??'';
        $this->valor = $data["valor"]??0;
        $this->estoque = $data["estoque"]??0;
        $this->peso = $data["peso"]?$data["peso"]:0;
        $this->descricao = $data["descricao"]??'';
        $this->descricaoResumida = $data["descricaoResumida"]?$data["descricaoResumida"]:'';
        $this->status = $data["status"]??1;
        $this->foto1 = $data["foto1"]??'';
        $this->foto2 = $data["foto2"]??'';
        $this->foto3 = $data["foto3"]??'';
    }

    public static function getProdutos(){
        try{
        $pdo = self::getConnection();
        $idUsuario = $_SESSION['idUsuario'];
        $sql = "SELECT pr.*, p.loja, p.nome as nomeCliente FROM produto pr inner join pessoa p on p.id = pr.idCliente WHERE p.status!=999 AND pr.status!=999";
        if($_SESSION['grupo'] == 2)
        $sql.=" AND pr.idCliente='$idUsuario'";
        $stm = $pdo->query($sql);
        $produtos = array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $produtos[] = new Produto($row);
        }
        return $produtos;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getProduto($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT pr.*, p.loja, p.nome as nomeCliente, fp.foto1,fp.foto2,fp.foto3 FROM produto pr inner join pessoa p on p.id = pr.idCliente left join fotoProduto fp on fp.idProduto = pr.id WHERE pr.id='$id'");
            $rs = $stm->fetch(PDO::FETCH_ASSOC);
            if($rs)
                return new Produto($rs);
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
            $this->valor = str_replace(',','.',str_replace('.','',$this->valor));
            $stm = $pdo->query("INSERT INTO produto (idCliente,idCategoria,idMarca,nome,sku,valor,estoque,peso,descricao,descricaoResumida,status)
            VALUES(
                '$this->idCliente',
                '$this->idCategoria',
                '$this->idMarca',
                '$this->nome',
                '$this->sku',
                '$this->valor',
                '$this->estoque',
                '$this->peso',
                '$this->descricao',
                '$this->descricaoResumida',
                '$this->status'
                )");
            if($stm)
                return $pdo->lastInsertId();
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
    public function update(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE produto SET
            idCliente = '$this->idCliente',
            idCategoria = '$this->idCategoria',
            idMarca = '$this->idMarca',
            nome = '$this->nome',
            sku = '$this->sku',
            peso = '$this->peso',
            descricao = '$this->descricao',
            descricaoResumida = '$this->descricaoResumida',
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

    public static function insertFotos($idProduto,$imagem1='',$imagem2='',$imagem3='')
    {
        $pdo = self::getConnection();
        $stm = $pdo->query("INSERT INTO fotoProduto(idProduto,foto1,foto2,foto3) VALUES('$idProduto','$imagem1','$imagem2','$imagem3')");
        if($stm)
        return true;
        return false;
    }

    public function delete(){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE produto set status = '999' where id = '$this->id'");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
}