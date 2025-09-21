<?php

require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . '/../config/db.php';


$controller = new HomeController($conn);

// Router básico
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    
    case '/login':
        $controller->showLogin();  // lista productos
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}
