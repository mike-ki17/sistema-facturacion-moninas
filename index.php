<?php
require_once __DIR__ . '/config/db.php';
// Cargar las rutas
// require_once __DIR__ . '/routes/web.php';

header("Location: /views/productos/index.php");
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

?>