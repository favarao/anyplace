<?php
class Usuario extends Database
{
    public $id;
    public $nome;
    public $login;
    public $senha;
    public $grupo;
    public $idCliente;
    public $status;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? 0;
        $this->nome = $data['nome'] ?? '';
        $this->login = $data['login'] ?? '';
        $this->senha = $data['senha'] ?? md5('123');
        $this->grupo = $data['grupo'] ?? 2;
        $this->idCliente = $data['idCliente'] ?? '';
        $this->status = $data['status'] ?? 1;
    }

    public static function autenticaLogin($usuario, $senha)
    {
        try {
            $pdo = self::getConnection();
            $stm = $pdo->query("SELECT u.*, p.nome FROM usuario u LEFT JOIN pessoa p on p.id = u.idCliente WHERE u.login = '$usuario' AND u.senha = '$senha'");
            if ($stm->fetch(PDO::FETCH_ASSOC))
                return new Usuario($stm->fetch(PDO::FETCH_ASSOC));
            return false;
        } catch (PDOException $e) {
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function getUsuarioByLogin($login = '', $idCliente ='')
    {
        try {
            $pdo = self::getConnection();
            $sql = "SELECT u.*, p.nome from usuario u left join pessoa p on p.id = u.idCliente";
            if($login)
            $sql .= " where login like '$login'"; 
            elseif($idCliente)
            $sql .= " where idCliente ='$idCliente'";
            $stm = $pdo->query($sql);
            if ($stm)
                return new Usuario($stm->fetch(PDO::FETCH_ASSOC));
            return false;
        } catch (PDOException $e) {
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public function insert()
    {
        try {
            $pdo = self::getConnection();
            $stm = $pdo->query("INSERT INTO usuario(login,senha,idCliente,grupo,status)
            values
            (
                '$this->login',
                '$this->senha',
                '$this->idCliente',
                '$this->grupo',
                '$this->status'
            )");
            if ($stm)
                return true;
            return false;
        } catch (PDOException $e) {
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public function update()
    {
        try {
            $pdo = self::getConnection();
            $stm = $pdo->query("UPDATE usuario SET
            login = '$this->login',
            senha = '$this->senha',
            idCliente = '$this->idCliente',
            grupo = '$this->grupo',
            status = '$this->status'
            WHERE id = '$this->id'
            ");
            if ($stm)
                return true;
            return false;
        } catch (PDOException $e) {
            throw new Exception(print_r($e->errorInfo));
        }
    }

    public static function novaSenha($idUsuario, $senha, $senha2)
    {
        $msg = '';
        if ($senha != $senha2)
            $msg .= "Senhas não são iguais<br>";
        if (strlen($senha) < 6)
            $msg .= "Tamanho mínimo de 6 caracteres<br>";
        if ($senha == '123')
            $msg .= "Senha não pode ser igual a senha inicial<br>";
        if ($msg == '') {
            try {
                $senha = md5($senha);
                $pdo = self::getConnection();
                $stm = $pdo->query("UPDATE usuario SET senha = '$senha' where id = '$idUsuario'");
                return ['success' => true, 'msg' => 'Sucesso ao ao alterar senha'];
            } catch (PDOException $e) {
                return ['success' => false, 'msg' => 'Erro ao alterar senha'];
            }
        } else {
            return ['success' => false, 'msg' => $msg];
        }
    }

}