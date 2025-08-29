<?php
require_once __DIR__ . '/controllers/ProductoController.php';
require_once __DIR__ . '/config/db.php';

if (isset($_GET['id'])) {
    $controller = new ProductoController($conn);
    $controller->destroy($_GET['id']);
} else {
    echo "ID de producto no especificado.";
}