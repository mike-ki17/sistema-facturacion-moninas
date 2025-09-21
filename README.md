# Sistema de Facturación Moninas

Sistema de gestión de productos y usuarios con autenticación completa.

## 🚀 Instalación

### 1. Configurar Base de Datos

Crear la tabla de usuarios:
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- encriptada con bcrypt
    rol ENUM('admin','vendedor') DEFAULT 'vendedor',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Crear Usuarios Iniciales

Ejecutar el script SQL:
```bash
mysql -u tu_usuario -p tu_base_de_datos < create_admin_user.sql
```

O ejecutar manualmente:
```sql
-- Usuario Administrador
INSERT INTO usuarios (nombre, correo, password, rol) VALUES 
('Administrador', 'admin@moninas.com', '$2y$10$TJOVxCmf014WhhGNFpW/nuN4iOaydENiSowA50DdqoWdvtbLoaGh6', 'admin');

-- Usuario Vendedor
INSERT INTO usuarios (nombre, correo, password, rol) VALUES 
('Vendedor Prueba', 'vendedor@moninas.com', '$2y$10$DKFPjr/Gk1BRk1z9vRiHpuPZ/A1ZaK7Y6bttdEwfPOusgUrlpBv.6', 'vendedor');
```

## 🔐 Credenciales de Acceso

### Administrador
- **Correo:** admin@moninas.com
- **Contraseña:** admin123
- **Permisos:** Gestión completa de usuarios y productos

### Vendedor
- **Correo:** vendedor@moninas.com
- **Contraseña:** vendedor123
- **Permisos:** Solo gestión de productos

## 📁 Estructura del Proyecto

```
sistema-facturacion-moninas/
├── config/
│   └── db.php                 # Configuración de base de datos
├── controllers/
│   ├── HomeController.php     # Controlador principal y autenticación
│   └── ProductoController.php # Controlador de productos
├── models/
│   ├── Usuario.php           # Modelo de usuarios
│   └── Producto.php          # Modelo de productos
├── views/
│   ├── home/
│   │   ├── index.php         # Página principal
│   │   └── login.php         # Formulario de login
│   ├── usuarios/
│   │   ├── index.php         # Lista de usuarios
│   │   └── create.php        # Crear usuario
│   └── productos/
│       ├── index.php         # Lista de productos
│       ├── crear.php         # Crear producto
│       └── edit.php          # Editar producto
├── routes/
│   └── web.php               # Rutas de la aplicación
├── create_admin_user.sql     # Script de usuarios iniciales
├── generate_password_hash.php # Generador de hashes
└── index.php                 # Punto de entrada
```

## 🛠️ Funcionalidades

### Autenticación
- ✅ Login con correo y contraseña
- ✅ Contraseñas encriptadas con bcrypt
- ✅ Gestión de sesiones
- ✅ Control de acceso por roles
- ✅ Logout seguro

### Gestión de Usuarios (Solo Admin)
- ✅ Crear nuevos usuarios
- ✅ Listar usuarios existentes
- ✅ Asignar roles (admin/vendedor)
- ✅ Validación de correos únicos

### Gestión de Productos
- ✅ Crear productos
- ✅ Listar productos
- ✅ Editar productos
- ✅ Eliminar productos
- ✅ Interfaz responsive

## 🔧 Herramientas Adicionales

### Generar Hash de Contraseña
```bash
php generate_password_hash.php
```

### Cambiar Contraseña de Usuario
```sql
UPDATE usuarios 
SET password = '$2y$10$nuevo_hash_aqui' 
WHERE correo = 'usuario@ejemplo.com';
```

## 🎨 Características de la Interfaz

- **Diseño Moderno:** Gradientes y efectos visuales
- **Responsive:** Adaptable a dispositivos móviles
- **Bootstrap 5:** Framework CSS moderno
- **Font Awesome:** Iconos profesionales
- **UX Mejorada:** Navegación intuitiva

## 🔒 Seguridad

- **Encriptación:** Contraseñas con bcrypt
- **Validación:** Formularios con validación del lado servidor
- **Sesiones:** Gestión segura de sesiones
- **Roles:** Control de acceso granular
- **Protección:** Middleware de autenticación

## 📱 Rutas Disponibles

| Ruta | Descripción | Acceso |
|------|-------------|---------|
| `/` | Página principal | Público |
| `/login` | Formulario de login | Público |
| `/auth` | Procesar login | POST |
| `/logout` | Cerrar sesión | Autenticado |
| `/dashboard` | Dashboard principal | Autenticado |
| `/productos` | Gestión de productos | Autenticado |
| `/usuarios` | Gestión de usuarios | Solo Admin |
| `/usuarios/create` | Crear usuario | Solo Admin |

## 🚀 Uso

1. Acceder a la página principal (`/`)
2. Hacer clic en "Iniciar Sesión"
3. Usar las credenciales del administrador
4. Desde el dashboard, gestionar productos y usuarios
5. Los administradores pueden crear nuevos usuarios
6. Los vendedores solo pueden gestionar productos

## 📝 Notas

- Las contraseñas se encriptan automáticamente al crear usuarios
- Solo los administradores pueden acceder a la gestión de usuarios
- El sistema redirige automáticamente según el rol del usuario
- Todas las rutas sensibles requieren autenticación

