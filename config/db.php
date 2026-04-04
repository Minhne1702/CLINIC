<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Database
{
    private $client;
    private $db;

    public function __construct()
    {
        try {
            $this->client = new MongoDB\Client("mongodb://127.0.0.1:27017");
            $this->db = $this->client->selectDatabase('Projects');
        } catch (Exception $e) {
            die("Lỗi kết nối MongoDB: " . $e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }
}