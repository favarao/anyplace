<?php
class Database {
    public static function getConnection()
    {
        $host = 'mysql';
        $usuario = 'root';
        $senha = 'root';
        $banco = 'anyplace';
        try {
            $dsn = "mysql:host=$host;dbname=$banco;charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $usuario, $senha, $options);
        $pdo->exec("SET NAMES utf8");
        $pdo->exec("SET CHARACTER SET utf8");
        return $pdo;
        } catch (PDOException $err) {
        echo "Sorry, something went wrong, verify database";
        exit();
        }
    }
}