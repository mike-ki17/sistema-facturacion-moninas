<?php

require_once __DIR__ . '/../config/db.php';

class Producto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM productos";
        $result = $this->conn->query($sql);
         return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function create($data) {
        $nombre = $this->conn->real_escape_string($data['nombre']);
        $precio = $this->conn->real_escape_string($data['precio']);
        $stock = $this->conn->real_escape_string($data['stock']);

        $sql = "INSERT INTO productos (nombre, precio, stock) VALUES ('$nombre', '$precio', '$stock')";
         if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            die("Error en la consulta: " . $this->conn->error);
        }
    }


    public function delete ($id){
         $id = $this->conn->real_escape_string($id);
        $sql = "DELETE FROM productos WHERE id = $id";
        return $this->conn->query($sql);
    }
}