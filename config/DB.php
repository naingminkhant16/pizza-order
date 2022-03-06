<?php

class DB
{
    const dbhost = "localhost:8080";
    const dbname = "pizza_order";
    const username = "root";
    const password = '';
    public $pdo;
    public $query;
    public $data;
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:dbhost=" . self::dbhost . ";dbname=" . self::dbname, self::username, self::password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function get()
    {
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->data);
        return $stmt->fetch();
    }
}
