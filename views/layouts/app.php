<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Sistema de Facturación Moninas'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #E67E22;
            --secondary-color: #F39C12;
            --success-color: #F39C12;
            --warning-color: #E67E22;
            --danger-color: #C0392B;
            --info-color: #D35400;
            --dark-color: #A04000;
            --light-color: #FEF9E7;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #FEF9E7;
            min-height: 100vh;
        }

        .navbar-custom {
            background: var(--primary-color);
            box-shadow: 0 4px 20px rgba(230, 126, 34, 0.3);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .btn-custom {
            background: var(--primary-color);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.4);
            color: white;
        }

        .btn-success-custom {
            background: var(--success-color);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success-custom:hover {
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
            color: white;
        }

        .btn-warning-custom {
            background: var(--warning-color);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning-custom:hover {
            box-shadow: 0 8px 25px rgba(230, 126, 34, 0.4);
            color: white;
        }

        .btn-danger-custom {
            background: var(--danger-color);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger-custom:hover {
            box-shadow: 0 8px 25px rgba(192, 57, 43, 0.4);
            color: white;
        }

        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control-custom:focus {
            border-color: #E67E22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
            background: white;
        }

        .table-custom {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            background: white;
            padding: 20px;
        }

        .table-custom thead th {
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table-custom tbody tr {
            transition: all 0.3s ease;
        }

        .table-custom tbody tr:hover {
            background: rgba(230, 126, 34, 0.05);
            transform: scale(1.01);
        }

        .badge-custom {
            border-radius: 20px;
            padding: 8px 16px;
            font-weight: 500;
        }

        .stats-card {
            background: var(--primary-color);
            color: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(230, 126, 34, 0.3);
        }

        .stats-card .icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .stats-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        /* Estilos específicos para valores monetarios grandes */
        .stats-card .number[data-type="currency"] {
            font-size: 2rem;
        }
        
        @media (max-width: 768px) {
            .stats-card .number {
                font-size: 2rem;
            }
            
            .stats-card .number[data-type="currency"] {
                font-size: 1.5rem;
            }
        }

        .page-header {
            background: transparent;
            color: #343a40;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 2px solid #E67E22;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #E67E22;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            color: #8B4513;
        }

        .alert-custom {
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .alert-success-custom {
            background: #FEF9E7;
            color: #A04000;
            border-left: 4px solid #E67E22;
            padding: 20px;
        }

        .alert-danger-custom {
            background: #FADBD8;
            color: #C0392B;
            border-left: 4px solid #C0392B;
            padding: 20px;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .sidebar-item {
            display: block;
            padding: 18px 25px;
            margin-bottom: 10px;
            border-radius: 12px;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-item:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-item.active {
            background: var(--primary-color);
            color: white;
        }

        .sidebar-item i {
            margin-right: 10px;
            width: 20px;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .stats-card {
                margin-bottom: 20px;
            }
            
            .table-custom tbody tr:hover {
                transform: none;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Mejorar padding de contenedores */
        .container {
            padding-left: 2rem;
            padding-right: 2rem;
        }
        
        .container-fluid {
            padding-left: 2rem;
            padding-right: 2rem;
        }
        
        .row {
            margin-left: -1rem;
            margin-right: -1rem;
        }
        
        .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
        .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-receipt me-2"></i>Sistema de Facturación
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <span class="navbar-text me-3">
                        <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario'); ?>
                    </span>
                    <a class="nav-link me-3" href="/productos">
                        <i class="fas fa-box me-1"></i>Productos
                    </a>
                    <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                        <a class="nav-link me-3" href="/dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                        <a class="nav-link me-3" href="/usuarios">
                            <i class="fas fa-users me-1"></i>Usuarios
                        </a>
                    <?php endif; ?>
                    <a class="nav-link" href="/logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="fade-in">
        <?php echo $content ?? ''; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animaciones y efectos
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de aparición para las tarjetas
            const cards = document.querySelectorAll('.card-custom');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Efecto hover para botones
            const buttons = document.querySelectorAll('.btn-custom');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
