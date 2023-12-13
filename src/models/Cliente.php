<?php 
class Cliente extends Database{
    public $id;
    public $nome;
    public $cnpj;
    public $email;
    public $telefone;
    public $celular;
    public $contato;
    public $endereco;
    public $status;



    public function __construct($data){
        $this->id = $data["id"]??0;
        $this->nome = $data["nome"]??'';
        $this->cnpj = $data["cnpj"]??'';
        $this->email = $data["email"]??'';
        $this->telefone = $data["telefone"]??'';
        $this->celular = $data["celular"]??'';
        $this->contato = $data["contato"]??'';
        $this->endereco = $data["endereco"]??'';
        $this->status = $data["status"]??1;
    }

    public static function getClientes(){
        try{
        $pdo = self::getConnection();
        $stm = $pdo->query("SELECT p.* FROM pessoa p WHERE p.status!=999");
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
            $stm = $pdo->query("SELECT * FROM pessoa where id = '$id'");
            return new Cliente($stm->fetch(PDO::FETCH_ASSOC));
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
            $stm = $pdo->query("INSERT INTO pessoa (nome,cnpj,email,telefone,celular,contato,endereco,status)
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
            nome = '$this->nome',
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

    public static function delete($id){
        try{
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE cliente set status = '999' where id = '$id'");
            if($stm)
                return true;
            return false;
        }catch(PDOException $e){
            throw new Exception(print_r($e->errorInfo));
        }
    }
}