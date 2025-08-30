<?php
require_once __DIR__ . '/../vendor/autoload.php'; // ruta correcta

use Dotenv\Dotenv;

// Cargar el .env desde la raíz
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Probar si se cargó
// var_dump(getenv('DB_HOST'));

// Conexión MySQL
$host = $_ENV['DB_HOST'] ?? null;
$user = $_ENV['DB_USER'] ?? null;
$pass = $_ENV['DB_PASS'] ?? null;
$db   = $_ENV['DB_NAME'] ?? null;
$port = (int) ($_ENV['DB_PORT'] ?? 3306);


$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
