<?php
require_once __DIR__ . '/controllers/ProductoController.php';
require_once __DIR__ . '/config/db.php';

$controller = new ProductoController($conn);
$controller->store();

