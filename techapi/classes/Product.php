<?php
class Product {
    private $conn;
    private $table = "products";
    public function __construct($db) {
        $this->conn = $db;
    }
    public function getAll() {
        $result = $this->conn->query("SELECT id,name,price FROM ".$this->table." WHERE active=1");
        $products = [];
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
}
