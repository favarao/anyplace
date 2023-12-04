L<?php
class Database {
    private $pdo;

    public function __construct($host = 'localhost:8081', $dbname = 'anyplace', $username = 'root', $password = 'root') {
        // Conectar ao banco de dados usando PDO
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function beginTransaction() {
        // Inicia a transação
        $this->pdo->beginTransaction();
    }

    public function commit() {
        // Confirma a transação
        $this->pdo->commit();
    }

    public function rollBack() {
        // Desfaz a transação em caso de erro
        $this->pdo->rollBack();
    }

}