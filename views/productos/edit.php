<?php
$title = 'Editar Producto - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-edit me-3"></i>Editar Producto
                </h1>
                <p class="page-subtitle">Modifica la información del producto: <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong></p>
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

                    <!-- Información Actual del Producto -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-primary text-white border-0 rounded-3 p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="mb-2">
                                            <i class="fas fa-info-circle me-2"></i>Información Actual
                                        </h5>
                                        <p class="mb-0">ID: #<?php echo htmlspecialchars($producto['id']); ?> | 
                                        Precio: $<?php echo number_format($producto['precio'], 0); ?> | 
                                        Stock: <?php echo htmlspecialchars($producto['stock']); ?> unidades</p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-box" style="font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="/productos/update" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">

                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-12 mb-4">
                                <label for="nombre" class="form-label fw-bold">
                                    <i class="fas fa-box me-2 text-primary"></i>Nombre del Producto
                                </label>
                                <input type="text" 
                                       class="form-control form-control-custom" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                                       placeholder="Ingresa el nombre del producto" 
                                       required>
                                <div class="invalid-feedback">
                                    Por favor, ingresa el nombre del producto.
                                </div>
                            </div>

                            <!-- Precio y Stock -->
                            <div class="col-md-6 mb-4">
                                <label for="precio" class="form-label fw-bold">
                                    <i class="fas fa-dollar-sign me-2 text-success"></i>Precio
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
                                           id="precio" 
                                           name="precio" 
                                           step="0.01" 
                                           min="0"
                                           value="<?php echo htmlspecialchars($producto['precio']); ?>" 
                                           placeholder="0.00" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, ingresa un precio válido.
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="stock" class="form-label fw-bold">
                                    <i class="fas fa-cubes me-2 text-info"></i>Stock Actual
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-info text-white">
                                        <i class="fas fa-cubes"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
                                           id="stock" 
                                           name="stock" 
                                           min="0"
                                           value="<?php echo htmlspecialchars($producto['stock']); ?>" 
                                           placeholder="0" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, ingresa la cantidad en stock.
                                </div>
                            </div>
                        </div>

                        <!-- Cambios Realizados -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light border-0 rounded-3 p-4 mb-4">
                                    <h6 class="fw-bold text-primary mb-3">
                                        <i class="fas fa-history me-2"></i>Historial de Cambios
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-edit text-warning mb-2" style="font-size: 2rem;"></i>
                                                <h6 class="fw-bold">Edición</h6>
                                                <small class="text-muted">Modifica información</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-save text-success mb-2" style="font-size: 2rem;"></i>
                                                <h6 class="fw-bold">Guardar</h6>
                                                <small class="text-muted">Aplica cambios</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="p-3">
                                                <i class="fas fa-check text-primary mb-2" style="font-size: 2rem;"></i>
                                                <h6 class="fw-bold">Confirmar</h6>
                                                <small class="text-muted">Verifica datos</small>
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
                                <button type="submit" class="btn btn-warning-custom btn-lg">
                                    <i class="fas fa-save me-2"></i>Actualizar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-body text-center">
                            <i class="fas fa-eye text-info mb-3" style="font-size: 3rem;"></i>
                            <h5>Ver Producto</h5>
                            <p class="text-muted">Visualiza la información completa</p>
                            <button class="btn btn-info btn-custom" onclick="alert('Función próximamente disponible')">
                                <i class="fas fa-eye me-2"></i>Ver Detalles
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line text-success mb-3" style="font-size: 3rem;"></i>
                            <h5>Estadísticas</h5>
                            <p class="text-muted">Analiza el rendimiento</p>
                            <button class="btn btn-success-custom" onclick="alert('Función próximamente disponible')">
                                <i class="fas fa-chart-bar me-2"></i>Ver Stats
                            </button>
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

    // Efecto de resaltado para campos modificados
    inputs.forEach(input => {
        const originalValue = input.value;
        input.addEventListener('input', function() {
            if (this.value !== originalValue) {
                this.style.borderColor = '#ffc107';
                this.style.backgroundColor = '#fff3cd';
            } else {
                this.style.borderColor = '#e9ecef';
                this.style.backgroundColor = 'white';
            }
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>