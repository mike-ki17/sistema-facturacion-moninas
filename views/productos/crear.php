<?php
$title = 'Crear Producto - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-plus-circle me-3"></i>Crear Producto
                </h1>
                <p class="page-subtitle">Registra un nuevo producto en tu inventario</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/productos" class="btn btn-custom btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Productos
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-custom">
                <div class="card-body p-5">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger-custom alert-custom">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success-custom alert-custom">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="/productos/store" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-12 mb-4">
                                <label for="nombre" class="form-label fw-bold">
                                    <i class="fas fa-box me-2" style="color: #D2691E;"></i>Nombre del Producto
                                </label>
                                <input type="text" 
                                       class="form-control form-control-custom" 
                                       id="nombre" 
                                       name="nombre" 
                                       placeholder="Ingresa el nombre del producto" 
                                       required>
                                <div class="invalid-feedback">
                                    Por favor, ingresa el nombre del producto.
                                </div>
                            </div>

                            <!-- Precio y Stock -->
                            <div class="col-md-6 mb-4">
                                <label for="precio" class="form-label fw-bold">
                                    <i class="fas fa-dollar-sign me-2" style="color: #B8860B;"></i>Precio
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-white" style="background: linear-gradient(135deg, #B8860B 0%, #DAA520 100%);">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
                                           id="precio" 
                                           name="precio" 
                                           step="0.01" 
                                           min="0"
                                           placeholder="0.00" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, ingresa un precio válido.
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="stock" class="form-label fw-bold">
                                    <i class="fas fa-cubes me-2" style="color: #FF8C00;"></i>Stock Inicial
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-white" style="background: linear-gradient(135deg, #FF8C00 0%, #FFA500 100%);">
                                        <i class="fas fa-cubes"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
                                           id="stock" 
                                           name="stock" 
                                           min="0"
                                           placeholder="0" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, ingresa la cantidad en stock.
                                </div>
                            </div>
                        </div>

                        <!-- Información Adicional -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light border-0 rounded-3 p-4 mb-4">
                                    <h6 class="fw-bold mb-3" style="color: #FF6B35;">
                                        <i class="fas fa-info-circle me-2"></i>Información del Producto
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-box mb-2" style="font-size: 2rem; color: #FF6B35;"></i>
                                                <h6 class="fw-bold">Inventario</h6>
                                                <small class="text-muted">Gestiona tu stock</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-dollar-sign mb-2" style="font-size: 2rem; color: #FF9500;"></i>
                                                <h6 class="fw-bold">Precio</h6>
                                                <small class="text-muted">Define el valor</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-chart-line mb-2" style="font-size: 2rem; color: #FF8C00;"></i>
                                                <h6 class="fw-bold">Seguimiento</h6>
                                                <small class="text-muted">Monitorea ventas</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <a href="/productos" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success-custom btn-lg">
                                    <i class="fas fa-save me-2"></i>Guardar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card-custom mt-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #FF6B35;">
                        <i class="fas fa-lightbulb me-2"></i>Consejos para Productos
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Usa nombres descriptivos y claros
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Establece precios competitivos
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Mantén un stock adecuado
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Actualiza regularmente
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación del formulario
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Animación de entrada para los campos
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-control-custom');
    inputs.forEach((input, index) => {
        input.style.animationDelay = `${index * 0.1}s`;
        input.classList.add('fade-in');
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>