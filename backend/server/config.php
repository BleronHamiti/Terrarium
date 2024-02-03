<?php

class DatabaseConnection {
    private $host = 'localhost';
    private $db_name = 'Terrarium';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        try {
          
            $dsn = "mysql:host={$this->host};dbname={$this->db_name}";

           
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}



?>
