<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct($db) {
        $this->productoModel = new Producto($db);
    }

    public function index() {
        // $productos = $this->productoModel->getAll();
        // include __DIR__ . '/../views/productos/index.php';
        echo "Funca";
    }


    Public function store () {
       
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = $this->productoModel->create($_POST);

        if ($result) {
            header("Location: /views/productos/index.php");
            exit;
        } else {
            echo "❌ Error al registrar el producto.";
        }
        } else {
            echo "Método inválido.";
        }
        }

    public function destroy ($id) {
        if ($this->productoModel->delete($id)) {
            // Redirige o muestra mensaje
            header("Location: ./views/productos/index.php");
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    }
}  



