<?php
class Database {
    private $host = "localhost";
    private $db_name = "subtech_db";
    private $username = "subtech_user";
    private $password = "w.Y_IMgIHX(w";
    public $conn;
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            die(json_encode(["status"=>false,"message"=>"Database Connection Failed"]));
        }
        return $this->conn;
    }
}
