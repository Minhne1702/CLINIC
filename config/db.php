<?php
class Database
{
    private $host = "127.0.0.1";
    private $db_name = "Clinic";
    private $username = "root";
    private $password = "123456";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối MySQL: " . $e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->conn;
    }
}
