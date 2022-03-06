<?php

class DB
{
    private const dbhost = "localhost:8080";
    private const dbname = "pizza_order";
    private const username = "root";
    private const password = '';
    protected $pdo;
    protected $query;
    protected $data;
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
    public function make($query, $data, $crud)
    {
        $this->query = $query;
        $this->data = $data;
        return $this->$crud();
    }

    public function get()
    {
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->data);
        return $stmt->fetch();
    }
    public function insert()
    {
        $stmt = $this->pdo->prepare($this->query);
        return $stmt->execute($this->data);
    }
}
