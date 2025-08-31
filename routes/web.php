<?php

require_once __DIR__ . "/../controllers/ProductoController.php";
require_once __DIR__ . '/../config/db.php';


$controller = new ProductoController($conn);

// Router básico
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        echo "Holaa";
        break;

    case '/productos':
        $controller->index();  // lista productos
        break;

    case '/productos/form':
        $controller->createForm(); // Mostrar formulario
        break;

    case '/productos/store':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $controller->store($_POST);  // guarda producto
        }
        else{
            $controller->index();
        }
        break;

    case '/productos/editar':
        if (isset($_GET['id'])) {
            $controller->edit($_GET['id']);  // mostrar formulario edición
        } else {
            $controller->index();
        }
        break;

    case '/productos/update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update($_POST);
        }
        break;

    case '/productos/eliminar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $controller->destroy($_POST['id']); // Eliminar producto
        } else {
            $controller->index();
        }
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}
