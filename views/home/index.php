<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación Moninas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .hero-section {
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
        .hero-content {
            color: white;
            text-align: center;
        }
        .btn-custom {
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            margin: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary-custom {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
        }
        .btn-primary-custom:hover {
            background: white;
            color: #FF6B35;
            transform: translateY(-2px);
        }
        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: white;
        }
        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }
        .card-custom {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin: 1rem;
            transition: all 0.3s ease;
        }
        
        .card-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <div class="mb-4">
                            <i class="fas fa-receipt feature-icon"></i>
                        </div>
                        <h1 class="display-4 fw-bold mb-4">Sistema de Facturación Moninas</h1>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <p class="lead mb-3">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?>!</p>
                            <p class="lead mb-5">Gestiona tu negocio de manera eficiente con nuestro sistema de facturación completo</p>
                        <?php else: ?>
                            <p class="lead mb-5">Gestiona tu negocio de manera eficiente con nuestro sistema de facturación completo</p>
                        <?php endif; ?>
                        
                        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mb-5">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <!-- Usuario autenticado -->
                                <a href="/dashboard" class="btn btn-primary-custom btn-custom">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Ir al Dashboard
                                </a>
                                <a href="/logout" class="btn btn-secondary-custom btn-custom">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Cerrar Sesión
                                </a>
                            <?php else: ?>
                                <!-- Usuario no autenticado -->
                                <a href="/login" class="btn btn-primary-custom btn-custom">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Iniciar Sesión
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card-custom text-center">
                                    <i class="fas fa-boxes feature-icon"></i>
                                    <h5>Gestión de Productos</h5>
                                    <p class="small">Administra tu inventario de manera eficiente</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-custom text-center">
                                    <i class="fas fa-file-invoice feature-icon"></i>
                                    <h5>Facturación</h5>
                                    <p class="small">Crea y gestiona facturas profesionales</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-custom text-center">
                                    <i class="fas fa-chart-line feature-icon"></i>
                                    <h5>Reportes</h5>
                                    <p class="small">Analiza el rendimiento de tu negocio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
