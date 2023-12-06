<?php
class Database {
    public static function getConnection()
    {
        try {
        $pdo = new PDO("mysql:dbname=anyplace;host=mysql",'root','root');
        return $pdo;
        } catch (PDOException $err) {
        echo "Sorry, something went wrong, verify database";
        exit();
        }
    }
}