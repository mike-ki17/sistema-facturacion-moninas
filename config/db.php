<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Solo cargar .env si existe (local)
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// Obtener variables
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
$user = $_ENV['DB_USER'] ?? getenv('DB_USER');
$pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');
$db   = $_ENV['DB_NAME'] ?? getenv('DB_NAME');
$port = (int) ($_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? 3306);

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
