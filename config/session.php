<?php
// Inicialización de sesión segura
if (session_status() == PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
?>
