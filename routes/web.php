<?php
// routes/web.php

require_once __DIR__ . "/../controllers/ProductoController.php";
require_once __DIR__ . '/../config/db.php';



if (isset($_GET['controller'])) {
    $action = $_GET['action'];
    $controller = $_GET ['controller'];

    if ($controller == "producto"){
        $instance = new ProductoController($conn);
        $instance->$action();
    }

   
}
