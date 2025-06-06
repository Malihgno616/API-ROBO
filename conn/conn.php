<?php

class Conn {
    
    private $host = 'localhost';
    private $db = 'robots_db';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;
    private $dsn;
    public function __construct()
    {
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $this->connect();
    }
    public function connect()
    {
        return $this->pdo = new PDO($this->dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
    public function getConnection()
    {
        return $this->pdo;
    }
}