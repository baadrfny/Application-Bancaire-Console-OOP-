<?php 


class Db {

    private static $instance = null;
    private PDO $conn;

    private function __construct()
    {
        $this->conn = new PDO(
            "mysql:host=localhost;dbname=bankapp;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
            );
    }

    public static function getInstance(){
    if (self::$instance == null) {
        self::$instance = new Db();
    }
    return self::$instance;
}


public function getConnection(){
    return $this->conn;
}

}

$pdo = Db::getInstance()->getConnection();



   



?>