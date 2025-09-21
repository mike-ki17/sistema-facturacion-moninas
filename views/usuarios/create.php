<?php
$title = 'Crear Usuario - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-user-plus me-3"></i>Crear Usuario
                </h1>
                <p class="page-subtitle">Registra un nuevo usuario en el sistema</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/usuarios" class="btn btn-custom btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Usuarios
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

                    <form action="/usuarios/store" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <!-- Nombre Completo -->
                            <div class="col-md-12 mb-4">
                                <label for="nombre" class="form-label fw-bold">
                                    <i class="fas fa-user me-2" style="color: #FF6B35;"></i>Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control form-control-custom" 
                                       id="nombre" 
                                       name="nombre" 
                                       placeholder="Ingresa el nombre completo del usuario" 
                                       required>
                                <div class="invalid-feedback">
                                    Por favor, ingresa el nombre completo.
                                </div>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="col-md-12 mb-4">
                                <label for="correo" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2" style="color: #FF7043;"></i>Correo Electrónico
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-white" style="background: linear-gradient(135deg, #FF7043 0%, #FFAB91 100%);">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control form-control-custom" 
                                           id="correo" 
                                           name="correo" 
                                           placeholder="usuario@ejemplo.com" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, ingresa un correo electrónico válido.
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label fw-bold">
                                    <i class="fas fa-lock me-2" style="color: #FF8C00;"></i>Contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-white" style="background: linear-gradient(135deg, #FF8C00 0%, #FFA500 100%);">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control form-control-custom" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Mínimo 6 caracteres" 
                                           required 
                                           minlength="6">
                                </div>
                                <div class="invalid-feedback">
                                    La contraseña debe tener al menos 6 caracteres.
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    La contraseña debe tener al menos 6 caracteres
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="col-md-6 mb-4">
                                <label for="rol" class="form-label fw-bold">
                                    <i class="fas fa-user-tag me-2" style="color: #FF9500;"></i>Rol del Usuario
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-white" style="background: linear-gradient(135deg, #FF9500 0%, #FFB84D 100%);">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <select class="form-select form-control-custom" id="rol" name="rol" required>
                                        <option value="">Seleccionar rol...</option>
                                        <option value="vendedor">Vendedor</option>
                                        <option value="admin">Administrador</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, selecciona un rol para el usuario.
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Los administradores pueden gestionar usuarios
                                </div>
                            </div>
                        </div>

                        <!-- Información sobre Roles -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light border-0 rounded-3 p-4 mb-4">
                                    <h6 class="fw-bold mb-3" style="color: #FF6B35;">
                                        <i class="fas fa-info-circle me-2"></i>Información sobre Roles
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #FF9500 0%, #FFB84D 100%);">
                                                    <i class="fas fa-user-tie text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Vendedor</h6>
                                                    <small class="text-muted">Acceso a gestión de productos únicamente</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #E65100 0%, #FF6B35 100%);">
                                                    <i class="fas fa-user-shield text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Administrador</h6>
                                                    <small class="text-muted">Acceso completo al sistema</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="mb-3 mb-md-0">
                                <a href="/usuarios" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success-custom btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Crear Usuario
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
                        <i class="fas fa-lightbulb me-2"></i>Consejos para Usuarios
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Usa correos únicos y válidos
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Asigna roles apropiados
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Contraseñas seguras
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check me-2" style="color: #FF9500;"></i>
                                    Revisa permisos regularmente
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

// Validación de contraseña en tiempo real
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const feedback = this.nextElementSibling;
    
    if (password.length < 6) {
        this.setCustomValidity('La contraseña debe tener al menos 6 caracteres');
        feedback.textContent = 'La contraseña debe tener al menos 6 caracteres';
    } else {
        this.setCustomValidity('');
        feedback.textContent = 'Contraseña válida';
        feedback.className = 'valid-feedback';
    }
});

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