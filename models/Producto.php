<?php

require_once __DIR__ . '/../config/db.php';

class Producto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function create($data) {
        $sql = "INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        // Tipos de datos: s = string, d = double, i = integer
        $stmt->bind_param("sdi", $data['nombre'], $data['precio'], $data['stock']);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error en la consulta: " . $stmt->error);
        }
    }

    public function find ($id){
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" porque es un entero
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un solo producto
    }

    public function update ($data){
        $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error en prepare: " . $this->conn->error);
        }

        // Tipos de datos: s = string, d = double, i = integer
        $stmt->bind_param("sdii", $data['nombre'], $data['precio'], $data['stock'], $data['id']);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error en la consulta: " . $stmt->error);
        }
    }

    public function delete ($id){
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            die("Error al eliminar: " . $stmt->error);
        }
    }
}