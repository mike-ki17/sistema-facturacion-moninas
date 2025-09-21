<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - Sistema de Facturación Moninas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
      min-height: 100vh;
    }
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .btn-login {
      background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
      border: none;
      border-radius: 50px;
      padding: 12px 30px;
      transition: all 0.3s ease;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
    }
    .back-link {
      color: #FF6B35;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .back-link:hover {
      color: #E65100;
    }
  </style>
</head>
<body>
  <div class="login-container">

    <div class="card login-card p-5" style="max-width: 450px; width: 100%;">
      <div class="text-center mb-4">
        <i class="fas fa-receipt mb-3" style="font-size: 3rem; color: #FF6B35;"></i>
        <h3 class="fw-bold text-dark">Iniciar Sesión</h3>
        <p class="text-muted">Accede a tu sistema de facturación</p>
      </div>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form action="/auth" method="POST">
        <!-- Correo -->
        <div class="mb-4">
          <label for="correo" class="form-label fw-semibold">
            <i class="fas fa-envelope me-2"></i>Correo Electrónico
          </label>
          <input type="email" class="form-control form-control-lg" id="correo" name="correo" 
                 placeholder="Ingresa tu correo electrónico" required style="border-radius: 10px;">
        </div>

        <!-- Contraseña -->
        <div class="mb-4">
          <label for="password" class="form-label fw-semibold">
            <i class="fas fa-lock me-2"></i>Contraseña
          </label>
          <input type="password" class="form-control form-control-lg" id="password" name="password" 
                 placeholder="********" required style="border-radius: 10px;">
        </div>

        <!-- Botón -->
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-login btn-lg text-white fw-semibold">
            <i class="fas fa-sign-in-alt me-2"></i>Ingresar
          </button>
        </div>
      </form>

      <div class="text-center">
        <a href="/" class="back-link">
          <i class="fas fa-arrow-left me-2"></i>Volver al inicio
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
