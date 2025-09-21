<?php
$title = 'Gestión de Productos - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-boxes me-3"></i>Gestión de Productos
                </h1>
                <p class="page-subtitle">Administra tu inventario de productos de manera eficiente</p>
            </div>
            <div class="col-md-4 text-md-end">
                <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                    <a href="/productos/form" class="btn btn-custom btn-lg">
                        <i class="fas fa-plus me-2"></i>Nuevo Producto
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="number"><?php echo count($productos); ?></div>
                <div class="label">Total Productos</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #B8860B 0%, #DAA520 100%);">
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="number">$<?php echo number_format(array_sum(array_map(function($p) { return $p['precio'] * $p['stock']; }, $productos)), 0); ?></div>
                <div class="label">Valor Total</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #CD853F 0%, #DEB887 100%);">
                <div class="icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <div class="number"><?php echo array_sum(array_column($productos, 'stock')); ?></div>
                <div class="label">Stock Total</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #BC8F8F 0%, #D2B48C 100%);">
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="number"><?php echo count(array_filter($productos, function($p) { return $p['stock'] > 0; })); ?></div>
                <div class="label">Con Stock</div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th><i class="fas fa-box me-2"></i>Producto</th>
                            <th><i class="fas fa-dollar-sign me-2"></i>Precio</th>
                            <th><i class="fas fa-cubes me-2"></i>Stock</th>
                            <th><i class="fas fa-chart-bar me-2"></i>Estado</th>
                            <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($productos)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open" style="font-size: 4rem; opacity: 0.3;"></i>
                                        <h4 class="mt-3">No hay productos registrados</h4>
                                        <p>Comienza agregando tu primer producto al inventario</p>
                                        <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                                            <a href="/productos/form" class="btn btn-custom mt-3">
                                                <i class="fas fa-plus me-2"></i>Agregar Producto
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark">#<?php echo htmlspecialchars($producto['id']); ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(135deg, #D2691E 0%, #CD853F 100%);">
                                                <i class="fas fa-box text-white"></i>
                                            </div>
                                        </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($producto['nombre']); ?></h6>
                                                <small class="text-muted">Producto</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">$<?php echo number_format($producto['precio'], 0); ?></span>
                                    </td>
                                    <td>
                                        <span class="fw-bold"><?php echo htmlspecialchars($producto['stock']); ?></span>
                                        <small class="text-muted d-block">unidades</small>
                                    </td>
                                    <td>
                                        <?php if ($producto['stock'] > 10): ?>
                                            <span class="badge badge-custom" style="background: linear-gradient(135deg, #B8860B 0%, #DAA520 100%);">En Stock</span>
                                        <?php elseif ($producto['stock'] > 0): ?>
                                            <span class="badge badge-custom" style="background: linear-gradient(135deg, #CD853F 0%, #DEB887 100%);">Stock Bajo</span>
                                        <?php else: ?>
                                            <span class="badge badge-custom" style="background: linear-gradient(135deg, #A0522D 0%, #D2691E 100%);">Sin Stock</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                                            <div class="btn-group" role="group">
                                                <a href="/productos/editar?id=<?php echo $producto['id']; ?>" 
                                                   class="btn btn-warning-custom btn-sm" 
                                                   title="Editar Producto">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/productos/eliminar" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                                    <button type="submit" 
                                                            class="btn btn-danger-custom btn-sm" 
                                                            title="Eliminar Producto"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">
                                                <i class="fas fa-eye me-1"></i>Solo lectura
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-6">
            <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                <div class="card-custom">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle mb-3" style="font-size: 3rem; color: #D2691E;"></i>
                        <h5>Agregar Producto</h5>
                        <p class="text-muted">Registra un nuevo producto en tu inventario</p>
                        <a href="/productos/form" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>Nuevo Producto
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card-custom">
                    <div class="card-body text-center">
                        <i class="fas fa-eye mb-3" style="font-size: 3rem; color: #D2691E;"></i>
                        <h5>Vista de Productos</h5>
                        <p class="text-muted">Solo puedes visualizar los productos del inventario</p>
                        <span class="badge badge-custom" style="background: #6c757d;">
                            <i class="fas fa-lock me-1"></i>Solo Lectura
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-chart-pie mb-3" style="font-size: 3rem; color: #B8860B;"></i>
                    <h5>Reportes</h5>
                    <p class="text-muted">Visualiza estadísticas de tu inventario</p>
                    <button class="btn btn-success-custom" onclick="alert('Función próximamente disponible')">
                        <i class="fas fa-chart-bar me-2"></i>Ver Reportes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>