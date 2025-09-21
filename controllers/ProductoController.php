<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $producto;

    public function __construct($db) {
        $this->producto = new Producto($db);
        $this->startSession();
    }

    private function startSession() {
        // La sesión ya se inicializa globalmente en config/session.php
        // Este método se mantiene por compatibilidad pero no hace nada
    }

    private function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    private function requireAdmin() {
        $this->requireAuth();
        if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
            header('Location: /productos');
            exit();
        }
    }

    public function index() {
        $this->requireAuth();
        $productos = $this->producto->getAll();
        include __DIR__ . '/../views/productos/index.php';
    }

    public function createForm() {
        $this->requireAdmin();
        require __DIR__ . '/../views/productos/crear.php';
    }

    public function store($new) {
        $this->requireAdmin();
        if ($this->producto->create($new)) {
            header("Location: /productos");
            exit;
        } else {
            echo "❌ Error al registrar el producto.";
        }
    }

    public function edit($id) {
        $this->requireAdmin();
        $producto = $this->producto->find($id);
        require __DIR__ . '/../views/productos/edit.php';
    }

    public function update($data) {
        $this->requireAdmin();
        $this->producto->update($data);
        header("Location: /productos");
        exit;
    }

    public function destroy($id) {
        $this->requireAdmin();
        if ($this->producto->delete($id)) {
            header("Location: /productos");
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}  



