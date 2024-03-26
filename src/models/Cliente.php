<?php 
class Cliente extends Database{
    public $id;
    public $nome;
    public $loja;
    public $cnpj;
    public $email;
    public $telefone;
    public $celular;
    public $contato;
    public $endereco;
    public $login;
    public $status;



    public function __construct($data){
        $this->id = $data["id"]??0;
        $this->nome = $data["nome"]??'';
        $this->loja = $data["loja"]??'';
        $this->cnpj = $data["cnpj"]??'';
        $this->email = $data["email"]??'';
        $this->telefone = $data["telefone"]??'';
        $this->celular = $data["celular"]??'';
        $this->contato = $data["contato"]??'';
        $this->endereco = $data["endereco"]??'';
        $this->login = $data["login"]??'';
        $this->status = $data["status"]??1;
    }

    public static function getClientes(){
        try{
        $pdo = self::getConnection();
        $stm = $pdo->query("SELECT p.*, u.login FROM pessoa p left join usuario u on u.idCliente = p.id WHERE p.status!=999 ORDER BY p.nome ASC");
        $clientes = array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $clientes[] = new Cliente($row);
        }
        return $clientes;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getCliente($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT p.*, u.login FROM pessoa p left join usuario u on u.idCliente = p.id where p.id = '$id'");
            $rs = $stm->fetch(PDO::FETCH_ASSOC);
            if($rs)
            return new Cliente($rs);
                return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getClienteByUsuario($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT p.*, u.login FROM pessoa p left join usuario u on u.idCliente = p.id where u.id = '$id'");
            $rs = $stm->fetch(PDO::FETCH_ASSOC);
            if($rs)
            return new Cliente($rs);
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
            $stm = $pdo->query("INSERT INTO pessoa (nome,loja,cnpj,email,telefone,celular,contato,endereco,status)
            VALUES(
                '$this->nome',
                '$this->loja',
                '$this->cnpj',
                '$this->email',
                '$this->telefone',
                '$this->celular',
                '$this->contato',
                '$this->endereco',
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
            $stm = $pdo->query("UPDATE pessoa SET
            nome = '$this->nome',
            loja = '$this->loja',
            cnpj = '$this->cnpj',
            email = '$this->email',
            telefone = '$this->telefone',
            celular = '$this->celular',
            contato = '$this->contato',
            endereco = '$this->endereco',
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
            $stm = $pdo->query("UPDATE pessoa set status = '999' where id = '$this->id'");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
}