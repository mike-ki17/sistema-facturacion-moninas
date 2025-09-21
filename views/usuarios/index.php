<?php
$title = 'Gestión de Usuarios - Sistema de Facturación Moninas';
ob_start();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-users me-3"></i>Gestión de Usuarios
                </h1>
                <p class="page-subtitle">Administra los usuarios del sistema y sus permisos</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/usuarios/create" class="btn btn-custom btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
                </a>
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
                    <i class="fas fa-users"></i>
                </div>
                <div class="number"><?php echo count($usuarios); ?></div>
                <div class="label">Total Usuarios</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #E65100 0%, #FF6B35 100%);">
                <div class="icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="number"><?php echo count(array_filter($usuarios, function($u) { return $u['rol'] === 'admin'; })); ?></div>
                <div class="label">Administradores</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #FF9500 0%, #FFB84D 100%);">
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="number"><?php echo count(array_filter($usuarios, function($u) { return $u['rol'] === 'vendedor'; })); ?></div>
                <div class="label">Vendedores</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #FF8C00 0%, #FFA500 100%);">
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="number"><?php echo count(array_filter($usuarios, function($u) { 
                    return strtotime($u['creado_en']) >= strtotime('-30 days'); 
                })); ?></div>
                <div class="label">Nuevos (30 días)</div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card-custom">
        <div class="card-body p-0">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success-custom alert-custom m-4">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger-custom alert-custom m-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th><i class="fas fa-user me-2"></i>Usuario</th>
                            <th><i class="fas fa-envelope me-2"></i>Correo</th>
                            <th><i class="fas fa-user-tag me-2"></i>Rol</th>
                            <th><i class="fas fa-calendar me-2"></i>Registro</th>
                            <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($usuarios)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-users" style="font-size: 4rem; opacity: 0.3;"></i>
                                        <h4 class="mt-3">No hay usuarios registrados</h4>
                                        <p>Comienza agregando el primer usuario al sistema</p>
                                        <a href="/usuarios/create" class="btn btn-custom mt-3">
                                            <i class="fas fa-user-plus me-2"></i>Agregar Usuario
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark">#<?php echo htmlspecialchars($usuario['id']); ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($usuario['nombre']); ?></h6>
                                                <small class="text-muted">
                                                    <?php if ($usuario['id'] == $_SESSION['user_id']): ?>
                                                        <span class="text-primary">(Tú)</span>
                                                    <?php else: ?>
                                                        Usuario
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold"><?php echo htmlspecialchars($usuario['correo']); ?></span>
                                    </td>
                                    <td>
                                        <?php if ($usuario['rol'] === 'admin'): ?>
                                            <span class="badge badge-custom" style="background: linear-gradient(135deg, #E65100 0%, #FF6B35 100%);">
                                                <i class="fas fa-user-shield me-1"></i>Administrador
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-custom" style="background: linear-gradient(135deg, #FF9500 0%, #FFB84D 100%);">
                                                <i class="fas fa-user-tie me-1"></i>Vendedor
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="fw-bold"><?php echo date('d/m/Y', strtotime($usuario['creado_en'])); ?></span>
                                            <small class="text-muted d-block"><?php echo date('H:i', strtotime($usuario['creado_en'])); ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-warning-custom btn-sm" 
                                                    title="Editar Usuario"
                                                    onclick="alert('Función próximamente disponible')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <?php if ($usuario['id'] != $_SESSION['user_id']): ?>
                                                <button type="button" 
                                                        class="btn btn-danger-custom btn-sm" 
                                                        title="Eliminar Usuario"
                                                        onclick="alert('Función próximamente disponible')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" 
                                                        class="btn btn-outline-secondary btn-sm" 
                                                        title="No puedes eliminar tu propia cuenta"
                                                        disabled>
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
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
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus mb-3" style="font-size: 3rem; color: #FF6B35;"></i>
                    <h5>Agregar Usuario</h5>
                    <p class="text-muted">Registra un nuevo usuario en el sistema</p>
                    <a href="/usuarios/create" class="btn btn-custom">
                        <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-custom">
                <div class="card-body text-center">
                    <i class="fas fa-shield-alt mb-3" style="font-size: 3rem; color: #FF9500;"></i>
                    <h5>Permisos</h5>
                    <p class="text-muted">Gestiona roles y permisos de usuarios</p>
                    <button class="btn btn-success-custom" onclick="alert('Función próximamente disponible')">
                        <i class="fas fa-cogs me-2"></i>Gestionar Permisos
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- User Roles Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card-custom">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: #FF6B35;">
                        <i class="fas fa-info-circle me-2"></i>Información sobre Roles
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #E65100 0%, #FF6B35 100%);">
                                    <i class="fas fa-user-shield text-white"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Administrador</h6>
                                    <small class="text-muted">Acceso completo al sistema, gestión de usuarios y productos</small>
                                </div>
                            </div>
                        </div>
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
                    </div>
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
            counter.textContent = Math.floor(current).toLocaleString();
        }, 16);
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>