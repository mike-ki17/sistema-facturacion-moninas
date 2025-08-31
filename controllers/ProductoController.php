<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $producto;

    public function __construct($db) {
        $this->producto = new Producto($db);
    }

    public function index() {
        $productos = $this->producto->getAll();
        include __DIR__ . '/../views/productos/index.php';

    }

    public function createForm() {
        require __DIR__ . '/../views/productos/crear.php';
    }


    Public function store ($new) {
        if ($this->producto->create($new)) {
            header("Location: /productos");
            exit;
        }else {
            echo "❌ Error al registrar el producto.";
        }

    }

    public function edit($id) {
        $producto = $this->producto->find($id);
        require __DIR__ . '/../views/productos/edit.php';
    }

    public function update($data) {
        $this->producto->update($data);
        header("Location: /productos");
        exit;
    }

    public function destroy ($id) {
        if ($this->producto->delete($id)) {
            header("Location: /productos");
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}  



