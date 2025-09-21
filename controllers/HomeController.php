
<?php
require_once __DIR__ . '/../models/Usuario.php';

class HomeController {
    private $conn;
    private $usuarioModel;

    public function __construct($connection) {
        $this->conn = $connection;
        $this->usuarioModel = new Usuario($connection);
        $this->startSession();
    }

    private function startSession() {
        // La sesión ya se inicializa globalmente en config/session.php
        // Este método se mantiene por compatibilidad pero no hace nada
    }

    public function index() {
        require __DIR__ . '/../views/home/index.php';
    }

    public function showLogin() {
        // Si ya está autenticado, redirigir al dashboard
        if ($this->isAuthenticated()) {
            header('Location: /dashboard');
            exit();
        }
        require __DIR__ . '/../views/home/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit();
        }

        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($correo) || empty($password)) {
            $_SESSION['error'] = 'Por favor, completa todos los campos';
            header('Location: /login');
            exit();
        }

        $usuario = $this->usuarioModel->findByEmail($correo);

        if (!$usuario || !$this->usuarioModel->verifyPassword($password, $usuario['password'])) {
            $_SESSION['error'] = 'Credenciales incorrectas';
            header('Location: /login');
            exit();
        }

        // Iniciar sesión
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nombre'] = $usuario['nombre'];
        $_SESSION['user_correo'] = $usuario['correo'];
        $_SESSION['user_rol'] = $usuario['rol'];

        header('Location: /dashboard');
        exit();
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit();
    }

    public function showDashboard() {
        if (!$this->isAuthenticated()) {
            header('Location: /login');
            exit();
        }
        
        // Obtener estadísticas para el dashboard
        $stats = $this->getDashboardStats();
        require __DIR__ . '/../views/dashboard/index.php';
    }

    private function getDashboardStats() {
        // Obtener estadísticas de productos
        $productosQuery = $this->conn->query("SELECT COUNT(*) as total, SUM(precio * stock) as valor_total, SUM(stock) as stock_total FROM productos");
        $productosStats = $productosQuery->fetch_assoc();

        // Obtener estadísticas de usuarios
        $usuariosQuery = $this->conn->query("SELECT COUNT(*) as total FROM usuarios");
        $usuariosStats = $usuariosQuery->fetch_assoc();

        // Obtener productos con stock bajo
        $stockBajoQuery = $this->conn->query("SELECT COUNT(*) as total FROM productos WHERE stock <= 10");
        $stockBajo = $stockBajoQuery->fetch_assoc();

        // Obtener productos sin stock
        $sinStockQuery = $this->conn->query("SELECT COUNT(*) as total FROM productos WHERE stock = 0");
        $sinStock = $sinStockQuery->fetch_assoc();

        // Obtener productos recientes
        $productosRecientesQuery = $this->conn->query("SELECT * FROM productos ORDER BY id DESC LIMIT 5");
        $productosRecientes = $productosRecientesQuery->fetch_all(MYSQLI_ASSOC);

        return [
            'productos' => [
                'total' => $productosStats['total'] ?? 0,
                'valor_total' => $productosStats['valor_total'] ?? 0,
                'stock_total' => $productosStats['stock_total'] ?? 0,
                'stock_bajo' => $stockBajo['total'] ?? 0,
                'sin_stock' => $sinStock['total'] ?? 0
            ],
            'usuarios' => [
                'total' => $usuariosStats['total'] ?? 0
            ],
            'productos_recientes' => $productosRecientes
        ];
    }

    public function showUsers() {
        if (!$this->isAuthenticated() || $_SESSION['user_rol'] !== 'admin') {
            header('Location: /dashboard');
            exit();
        }

        $usuarios = $this->usuarioModel->getAll();
        require __DIR__ . '/../views/usuarios/index.php';
    }

    public function showCreateUser() {
        if (!$this->isAuthenticated() || $_SESSION['user_rol'] !== 'admin') {
            header('Location: /dashboard');
            exit();
        }

        require __DIR__ . '/../views/usuarios/create.php';
    }

    public function createUser() {
        if (!$this->isAuthenticated() || $_SESSION['user_rol'] !== 'admin') {
            header('Location: /dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /usuarios/create');
            exit();
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';
        $rol = $_POST['rol'] ?? 'vendedor';

        // Validaciones
        if (empty($nombre) || empty($correo) || empty($password)) {
            $_SESSION['error'] = 'Todos los campos son obligatorios';
            header('Location: /usuarios/create');
            exit();
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo electrónico no es válido';
            header('Location: /usuarios/create');
            exit();
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
            header('Location: /usuarios/create');
            exit();
        }

        if ($this->usuarioModel->emailExists($correo)) {
            $_SESSION['error'] = 'El correo electrónico ya está registrado';
            header('Location: /usuarios/create');
            exit();
        }

        if ($this->usuarioModel->create($nombre, $correo, $password, $rol)) {
            $_SESSION['success'] = 'Usuario creado exitosamente';
            header('Location: /usuarios');
            exit();
        } else {
            $_SESSION['error'] = 'Error al crear el usuario';
            header('Location: /usuarios/create');
            exit();
        }
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function requireAuth() {
        if (!$this->isAuthenticated()) {
            header('Location: /login');
            exit();
        }
    }

    public function requireAdmin() {
        $this->requireAuth();
        if ($_SESSION['user_rol'] !== 'admin') {
            header('Location: /dashboard');
            exit();
        }
    }
}