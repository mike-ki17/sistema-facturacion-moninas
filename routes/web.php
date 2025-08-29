<?php
// routes/web.php

require_once __DIR__ . "/../controllers/ProductoController.php";

$routes = [
    "/view/productos/index" => function () {
        // var_dump("Entró a productos index");
        // exit;
    },
    "/productos/nuevo" => function () {
        echo "<h1>Crear Producto</h1>";
        // $controller = new ProductoController();
        // $controller->store(); // Llamar al método
    }
];
