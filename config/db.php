<?php
$host = "localhost";
$user = "root";   // tu usuario MySQL
$pass = "";       // tu contraseña
$db   = "sistema_facturacion";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
