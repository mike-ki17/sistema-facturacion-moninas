<?php
require_once __DIR__ . '/config/db.php';
// Cargar las rutas
// require_once __DIR__ . '/routes/web.php';

header("Location: /views/productos/index.php");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// // Buscar la ruta en el arreglo
// if (isset($routes[$uri])) {
//     $action = $routes[$uri];
//     var_dump($action);
//     exit;
//     $action(); // ejecuta la función asociada
// } else {
//     http_response_code(404);
//     echo "Ruta no encontrada: " . htmlspecialchars($uri);
// }
// exit;
// $controller = $_GET['controller'] ?? 'producto';
// $action = $_GET['action'] ?? 'index';

// switch ($controller) {
//     case 'producto':
//         echo "Yeahhh";
//         $productoController = new ProductoController($db);

//         if (method_exists($productoController, $action)) {
//             $productoController->$action();
//         } else {
//             echo "Método $action no encontrado en ProductoController";
//         }
//         break;

//     default:
//         echo "Controlador no válido";
// }
echo "<h1>Sistema de Facturación</h1>";
echo "<p>Conexión a la BD lista 🚀</p>";
?>