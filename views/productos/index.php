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
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- 👈 importante para móviles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Ajustes específicos para pantallas pequeñas */
        @media (max-width: 576px) {
            h1 {
                font-size: 1.6rem;
            }
            .btn {
                font-size: 1rem;
                padding: 0.6rem 1rem;
            }
            table {
                font-size: 0.95rem;
            }
            /* 👉 Vista tipo tarjeta en móvil */
            .table thead {
                display: none;
            }
            .table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
                padding: 0.8rem;
            }
            .table td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                border: none;
            }
            .table td::before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 0.5rem;
                color: #495057;
            }
        }
    </style>
</head>
<body class="p-3">
    <div class="container">
        <h1 class="mb-4 text-center">Lista de productos</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="crear.php" class="btn btn-primary w-100 w-sm-auto">+ Nuevo producto</a>
        </div>

        <!-- 👇 Aquí el wrapper responsive -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($productos)): ?>
                        <?php foreach($productos as $producto): ?>
                            <tr>
                                <td data-label="ID"><?= htmlspecialchars($producto['id']) ?></td>
                                <td data-label="Nombre"><?= htmlspecialchars($producto['nombre']) ?></td>
                                <td data-label="Precio">$<?= number_format($producto['precio'], 2) ?></td>
                                <td data-label="Stock"><?= htmlspecialchars($producto['stock']) ?></td>
                                <td data-label="Acciones" class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning mb-1">Editar</a>
                                    <a href="../../eliminarProducto.php?id=<?= $producto['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                       Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay productos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
