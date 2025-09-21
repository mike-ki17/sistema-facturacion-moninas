<?php
$title = 'Dashboard - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-tachometer-alt me-3"></i>Dashboard
                </h1>
                <p class="page-subtitle">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?> - Resumen de tu sistema</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex gap-2">
                    <a href="/productos" class="btn btn-custom btn-lg">
                        <i class="fas fa-boxes me-2"></i>Productos
                    </a>
                    <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                        <a href="/usuarios" class="btn btn-custom btn-lg">
                            <i class="fas fa-users me-2"></i>Usuarios
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="number"><?php echo $stats['productos']['total']; ?></div>
                <div class="label">Total Productos</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #F39C12;">
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="number" data-type="currency">$<?php echo number_format($stats['productos']['valor_total'], 0); ?></div>
                <div class="label">Valor Total</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #E67E22;">
                <div class="icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <div class="number"><?php echo $stats['productos']['stock_total']; ?></div>
                <div class="label">Stock Total</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: #D35400;">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="number"><?php echo $stats['usuarios']['total']; ?></div>
                <div class="label">Usuarios</div>
            </div>
        </div>
    </div>

    <!-- Alertas y Estado del Stock -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card-custom">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>Alertas de Stock
                    </h5>
                    
                    <?php if ($stats['productos']['sin_stock'] > 0): ?>
                        <div class="alert alert-danger-custom alert-custom mb-3">
                            <i class="fas fa-times-circle me-2"></i>
                            <strong><?php echo $stats['productos']['sin_stock']; ?></strong> productos sin stock
                        </div>
                    <?php endif; ?>

                    <?php if ($stats['productos']['stock_bajo'] > 0): ?>
                        <div class="alert alert-warning alert-custom mb-3" style="background: #FEF9E7; color: #A04000; border-left: 4px solid #E67E22; padding: 20px;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong><?php echo $stats['productos']['stock_bajo']; ?></strong> productos con stock bajo
                        </div>
                    <?php endif; ?>

                    <?php if ($stats['productos']['sin_stock'] == 0 && $stats['productos']['stock_bajo'] == 0): ?>
                        <div class="alert alert-success-custom alert-custom">
                            <i class="fas fa-check-circle me-2"></i>
                            ¡Excelente! Todos los productos tienen stock adecuado
                        </div>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                        <a href="/productos" class="btn btn-custom">
                            <i class="fas fa-boxes me-2"></i>Gestionar Productos
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card-custom">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-4">
                        <i class="fas fa-chart-pie me-2"></i>Resumen del Sistema
                    </h5>
                    
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-3">
                                <i class="fas fa-box text-primary mb-2" style="font-size: 2rem; color: #E67E22 !important;"></i>
                                <h6 class="fw-bold"><?php echo $stats['productos']['total']; ?></h6>
                                <small class="text-muted">Productos</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3">
                                <i class="fas fa-users text-warning mb-2" style="font-size: 2rem; color: #E67E22 !important;"></i>
                                <h6 class="fw-bold"><?php echo $stats['usuarios']['total']; ?></h6>
                                <small class="text-muted">Usuarios</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3">
                                <i class="fas fa-cubes text-info mb-2" style="font-size: 2rem; color: #E67E22 !important;"></i>
                                <h6 class="fw-bold"><?php echo $stats['productos']['stock_total']; ?></h6>
                                <small class="text-muted">Stock Total</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3">
                                <i class="fas fa-dollar-sign text-warning mb-2" style="font-size: 2rem; color: #F39C12 !important;"></i>
                                <h6 class="fw-bold">$<?php echo number_format($stats['productos']['valor_total'], 0); ?></h6>
                                <small class="text-muted">Valor Total</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos Recientes -->
    <div class="row">
        <div class="col-12">
            <div class="card-custom">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-primary mb-0">
                            <i class="fas fa-clock me-2"></i>Productos Recientes
                        </h5>
                        <a href="/productos" class="btn btn-custom btn-sm">
                            <i class="fas fa-eye me-2"></i>Ver Todos
                        </a>
                    </div>

                    <?php if (empty($stats['productos_recientes'])): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-box-open text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h5 class="text-muted">No hay productos registrados</h5>
                            <p class="text-muted">Comienza agregando tu primer producto</p>
                            <a href="/productos/form" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Agregar Producto
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                        <th><i class="fas fa-box me-2"></i>Producto</th>
                                        <th><i class="fas fa-dollar-sign me-2"></i>Precio</th>
                                        <th><i class="fas fa-cubes me-2"></i>Stock</th>
                                        <th><i class="fas fa-chart-bar me-2"></i>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stats['productos_recientes'] as $producto): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-light text-dark">#<?php echo htmlspecialchars($producto['id']); ?></span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                            <i class="fas fa-box text-white" style="font-size: 0.8rem;"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($producto['nombre']); ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">$<?php echo number_format($producto['precio'], 0); ?></span>
                                            </td>
                                            <td>
                                                <span class="fw-bold"><?php echo htmlspecialchars($producto['stock']); ?></span>
                                            </td>
                                            <td>
                                                <?php if ($producto['stock'] > 10): ?>
                                                    <span class="badge badge-custom bg-success">En Stock</span>
                                                <?php elseif ($producto['stock'] > 0): ?>
                                                    <span class="badge badge-custom bg-warning">Stock Bajo</span>
                                                <?php else: ?>
                                                    <span class="badge badge-custom bg-danger">Sin Stock</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>Agregar Producto</h5>
                    <p class="text-muted">Registra un nuevo producto en tu inventario</p>
                    <a href="/productos/form" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>Nuevo Producto
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-boxes text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>Gestionar Productos</h5>
                    <p class="text-muted">Administra tu inventario completo</p>
                    <a href="/productos" class="btn btn-success-custom">
                        <i class="fas fa-cogs me-2"></i>Gestionar
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line text-info mb-3" style="font-size: 3rem;"></i>
                    <h5>Reportes</h5>
                    <p class="text-muted">Analiza el rendimiento de tu negocio</p>
                    <button class="btn btn-info btn-custom" onclick="alert('Función próximamente disponible')">
                        <i class="fas fa-chart-bar me-2"></i>Ver Reportes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animación de contadores
    const counters = document.querySelectorAll('.stats-card .number');
    counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            if (counter.textContent.includes('$')) {
                counter.textContent = '$' + Math.floor(current).toLocaleString();
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    });

    // Efecto de pulso para alertas
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        if (alert.classList.contains('alert-danger-custom')) {
            alert.classList.add('pulse');
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
