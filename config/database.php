<?php
class Database
{
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "user_resources";

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}