
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

        // $productos = [];
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $productos[] = $row;
        //     }
        // }
        // return $productos;
         return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function create($data) {
        echo "Entró al método create";
        $nombre = $this->conn->real_escape_string($data['nombre']);
        $precio = $this->conn->real_escape_string($data['precio']);
        $stock = $this->conn->real_escape_string($data['stock']);
        // $categoria_id = $this->conn->real_escape_string($data['categoria_id']);

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