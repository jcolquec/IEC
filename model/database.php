<?php
class Database{

    private $db;

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        $this->db = new mysqli("localhost", "root", "", "starer");
        mysqli_set_charset($this->db, "utf8");
        if ($this->db->connect_error) {
            throw new Exception("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function getDB() {
        return $this->db;
    }

}
?>