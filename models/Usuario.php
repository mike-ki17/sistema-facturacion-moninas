<?php

class Usuario {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function findByEmail($correo) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($nombre, $correo, $password, $rol = 'vendedor') {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $hashedPassword, $rol);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function update($id, $nombre, $correo, $password = null, $rol = null) {
        if ($password) {
            // Si se proporciona una nueva contraseña, encriptarla
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE usuarios SET nombre = ?, correo = ?, password = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $nombre, $correo, $hashedPassword, $rol, $id);
        } else {
            // Si no se proporciona contraseña, no actualizarla
            $stmt = $this->conn->prepare("UPDATE usuarios SET nombre = ?, correo = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nombre, $correo, $rol, $id);
        }
        
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->conn->query("SELECT id, nombre, correo, rol, creado_en FROM usuarios ORDER BY creado_en DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function emailExists($correo, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE correo = ? AND id != ?");
            $stmt->bind_param("si", $correo, $excludeId);
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
            $stmt->bind_param("s", $correo);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}

