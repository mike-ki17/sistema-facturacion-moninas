<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Editar Producto</h4>
            </div>
            <div class="card-body">
                <form action="/productos/update" method="POST">
                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del producto</label>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               value="<?= htmlspecialchars($producto['nombre']) ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" 
                               class="form-control" 
                               id="precio" 
                               name="precio" 
                               step="0.01" 
                               value="<?= $producto['precio'] ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" 
                               class="form-control" 
                               id="stock" 
                               name="stock" 
                               value="<?= $producto['stock'] ?>" 
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="/productos" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
