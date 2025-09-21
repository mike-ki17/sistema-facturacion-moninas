<?php
require_once __DIR__ . "/../controllers/ProductoController.php";
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../config/db.php';

$controllerProducto = new ProductoController($conn);
$controllerHome = new HomeController($conn);

// Router básico
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        $controllerHome->index();  // Mostrar vista principal
        break;

    case '/productos':
        $controllerProducto->index();  // lista productos
        break;

    case '/productos/form':
        $controllerProducto->createForm(); // Mostrar formulario
        break;

    case '/productos/store':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $controllerProducto->store($_POST);  // guarda producto
        }
        else{
            $controllerProducto->index();
        }
        break;

    case '/productos/editar':
        if (isset($_GET['id'])) {
            $controllerProducto->edit($_GET['id']);  // mostrar formulario edición
        } else {
            $controllerProducto->index();
        }
        break;

    case '/productos/update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controllerProducto->update($_POST);
        }
        break;

    case '/productos/eliminar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $controllerProducto->destroy($_POST['id']); // Eliminar producto
        } else {
            $controllerProducto->index();
        }
        break;

    case '/login':
        $controllerHome->showLogin();
        break;

    case '/auth':
        $controllerHome->authenticate();
        break;

    case '/logout':
        $controllerHome->logout();
        break;

    case '/dashboard':
        $controllerHome->showDashboard();
        break;

    case '/usuarios':
        $controllerHome->showUsers();
        break;

    case '/usuarios/create':
        $controllerHome->showCreateUser();
        break;

    case '/usuarios/store':
        $controllerHome->createUser();
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}
