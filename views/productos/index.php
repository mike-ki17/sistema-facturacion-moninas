<?php
require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/Producto.php";
$instanceProductos = new Producto($conn);
$productos = $instanceProductos->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1 class="mb-4">Lista de productos</h1>
    <a href="crear.php" class="btn btn-primary mb-3">+ Nuevo producto</a>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($productos)): ?>
                <?php foreach($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['id']) ?></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Editar</a>
                            <a href="../../eliminarProducto.php?id=<?= $producto['id'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <p>No hay productos registrados.</p>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>