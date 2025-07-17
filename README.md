# 🚗 AutoMundo - Sistema de Gestión de Vehículos

<p align="center">
  <img src="https://img.icons8.com/ios-filled/100/007bff/car.png" alt="AutoMundo Logo" width="100">
  <br>
  <strong>Sistema Completo de Gestión de Vehículos con Roles de Usuario</strong>
</p>

## 📋 Descripción

AutoMundo es una aplicación web completa para la gestión de vehículos desarrollada con Laravel 11. El sistema incluye un robusto sistema de autenticación con múltiples roles de usuario (Administrador, Vendedor, Cliente), dashboards personalizados, gestión de inventario, y un sistema completo de recuperación de contraseñas.

## ✨ Características Principales

### 🔐 Sistema de Autenticación y Autorización
- **Sistema de roles**: Administrador, Vendedor, Cliente
- **Registro de usuarios** con validación de datos
- **Inicio de sesión** seguro con reCAPTCHA
- **Recuperación de contraseñas** por email con plantillas HTML profesionales
- **Protección de rutas** con middleware de autenticación y roles
- **Control de sesiones múltiples**
- **Logout seguro** con invalidación de sesiones

### 👥 Gestión de Usuarios (Admin)
- **Panel de administración** completo
- **Gestión de usuarios**: Crear, editar, cambiar roles, eliminar
- **Búsqueda de usuarios** en tiempo real
- **Configuración del sistema**: Tiempo de sesión, intentos de login, modo mantenimiento
- **Estadísticas de usuarios** y actividad
- **Interfaz con SweetAlert2** para confirmaciones y modales

### 🚗 Gestión de Vehículos por Rol
- **Administrador**: CRUD completo (Crear, Leer, Actualizar, Eliminar)
- **Vendedor**: Crear, editar y buscar vehículos (sin eliminar)
- **Cliente**: Vista informativa con detalles y contacto de vendedores
- **Búsqueda en tiempo real** por marca y modelo
- **Carga de imágenes** con preview
- **Validación de formularios** en frontend y backend
- **Interfaz responsiva** con animaciones suaves

### 📊 Dashboards Personalizados
- **Dashboard de Administrador**: Gestión de usuarios, estadísticas, configuración
- **Dashboard de Vendedor**: Inventario, estadísticas de ventas, actividad reciente
- **Dashboard de Cliente**: Perfil, vehículos favoritos, actividad reciente, acciones rápidas

### 🎨 Interfaz de Usuario Moderna
- **Diseño responsivo** con CSS personalizado
- **Animaciones fluidas** para mejor experiencia de usuario
- **Notificaciones interactivas** con SweetAlert2 y Toastify
- **Navegación adaptativa** según el rol del usuario
- **Iconos FontAwesome** para mejor UX
- **Colores y estilos consistentes** en toda la aplicación

### 📧 Sistema de Email
- **Plantillas HTML profesionales** para recuperación de contraseñas
- **Configuración flexible** para diferentes proveedores (SendGrid, SMTP, etc.)
- **Notificaciones personalizadas** por tipo de usuario

## 🛠️ Tecnologías Utilizadas

### Backend
- **Laravel 11** (PHP 8.1+)
- **SQLite** (Base de datos)
- **Laravel Sanctum** (Autenticación API)
- **Laravel Mail** (Sistema de emails)

### Frontend
- **JavaScript ES6+** (Vanilla)
- **CSS3** con variables CSS personalizadas
- **FontAwesome 6** (Iconos)
- **SweetAlert2** (Modales y notificaciones)
- **Toastify** (Notificaciones toast)
- **Vite** (Bundler de assets)

### Herramientas de Desarrollo
- **Composer** (Gestión de dependencias PHP)
- **npm** (Gestión de dependencias Node.js)
- **Git** (Control de versiones)

## 🚀 Instalación

### Requisitos Previos
- PHP 8.1 o superior
- Composer 2.0+
- Node.js 16+ y npm
- Git

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd u3dwp_sh
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

4. **Configurar el archivo de entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**
   ```bash
   # Editar .env para configurar SQLite
   DB_CONNECTION=sqlite
   DB_DATABASE=/ruta/absoluta/a/database/database.sqlite
   
   # Crear archivo de base de datos
   touch database/database.sqlite
   ```

6. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

7. **Crear enlace simbólico para storage**
   ```bash
   php artisan storage:link
   ```

8. **Compilar assets**
   ```bash
   npm run build
   ```

9. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

## 📁 Estructura del Proyecto

```
u3dwp_sh/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/
│   │   │   └── CarController.php          # API para gestión de vehículos
│   │   ├── Admin/
│   │   │   ├── UserController.php         # Gestión de usuarios (Admin)
│   │   │   └── SettingsController.php     # Configuración del sistema
│   │   ├── AuthController.php             # Controlador de autenticación
│   │   ├── ContactController.php          # Controlador de contacto
│   │   └── PasswordResetController.php    # Recuperación de contraseñas
│   ├── Models/
│   │   ├── Car.php                        # Modelo de vehículos
│   │   └── User.php                       # Modelo de usuarios con roles
│   ├── Notifications/
│   │   └── ResetPasswordNotification.php  # Notificación de recuperación
│   ├── Providers/
│   │   └── AppServiceProvider.php         # Configuración de servicios
│   └── Rules/
│       └── Recaptcha.php                  # Regla de validación reCAPTCHA
├── resources/
│   ├── js/
│   │   ├── app.js                         # JavaScript principal
│   │   ├── cars-ajax.js                   # Lógica de gestión de vehículos
│   │   ├── ajax-app.js                    # Funciones de prueba AJAX
│   │   └── services/
│   │       └── carApi.js                  # Servicio API de vehículos
│   ├── css/
│   │   └── app.css                        # Estilos principales
│   └── views/
│       ├── cars.blade.php                 # Vista principal de vehículos
│       ├── cars-ajax.blade.php            # Vista de pruebas AJAX
│       ├── auth/                          # Vistas de autenticación
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard/                     # Dashboards por rol
│       │   ├── admin.blade.php
│       │   ├── sales.blade.php
│       │   └── customer.blade.php
│       ├── admin/                         # Vistas de administración
│       │   ├── users.blade.php
│       │   └── settings.blade.php
│       ├── layouts/
│       │   └── app.blade.php              # Layout principal
│       └── password-recovery.blade.php    # Recuperación de contraseñas
├── routes/
│   └── web.php                            # Rutas de la aplicación
└── public/
    ├── css/
    │   └── styles.css                     # Estilos personalizados
    └── build/                             # Assets compilados
```

## 🎯 Funcionalidades Detalladas por Rol

### 👑 Administrador
- **Dashboard completo** con estadísticas y gestión
- **Gestión de usuarios**: Crear, editar, cambiar roles, eliminar
- **Configuración del sistema**: Parámetros globales
- **CRUD completo de vehículos**: Crear, editar, eliminar, buscar
- **Acceso a todas las funcionalidades**

### 💼 Vendedor
- **Dashboard de ventas** con estadísticas específicas
- **Gestión de vehículos**: Crear, editar, buscar (sin eliminar)
- **Panel informativo** con instrucciones
- **Navegación simplificada** sin acceso a gestión de usuarios

### 👤 Cliente
- **Dashboard personal** con perfil y actividad
- **Catálogo de vehículos** solo informativo
- **Acciones limitadas**: Ver detalles, contactar vendedor
- **Navegación básica** sin funciones administrativas

## 🔧 Configuración

### Variables de Entorno (.env)
```env
APP_NAME="AutoMundo"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/a/database/database.sqlite

# Configuración de Email
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=tu_api_key_sendgrid
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_email@dominio.com
MAIL_FROM_NAME="AutoMundo"

# reCAPTCHA
RECAPTCHA_SITE_KEY=tu_clave_del_sitio
RECAPTCHA_SECRET_KEY=tu_clave_secreta
```

### Configuración de Email
Para el sistema de recuperación de contraseñas, puedes usar:
- **SendGrid** (recomendado para producción)
- **Mailtrap** (para desarrollo)
- **SMTP local** (para pruebas)

### reCAPTCHA
Para habilitar reCAPTCHA:
1. Registrarse en [Google reCAPTCHA](https://www.google.com/recaptcha/)
2. Obtener las claves pública y secreta
3. Configurar en el archivo `.env`

## 🧪 Pruebas y Desarrollo

### Comandos Útiles
```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Compilar assets en desarrollo
npm run dev

# Compilar assets para producción
npm run build

# Verificar rutas
php artisan route:list
```

### Interfaz de Pruebas
- **Vehículos**: `/cars` - Gestión completa de vehículos
- **Pruebas AJAX**: `/cars-ajax` - Interfaz de pruebas de la API
- **Dashboard Admin**: `/admin/dashboard` - Panel de administración
- **Dashboard Sales**: `/sales/dashboard` - Panel de ventas
- **Dashboard Customer**: `/dashboard` - Panel de cliente

## 🎨 Personalización

### Estilos CSS
Los estilos principales se encuentran en:
- `resources/css/app.css` - Estilos con Vite
- `public/css/styles.css` - Estilos personalizados y componentes

### JavaScript
La lógica principal está en:
- `resources/js/cars-ajax.js` - Gestión de vehículos con roles
- `resources/js/app.js` - Validaciones y utilidades
- `resources/js/services/carApi.js` - Servicio API

### Variables CSS
El sistema usa variables CSS para consistencia:
```css
:root {
  --main-color: #E60012;
  --second-color: #FF6B35;
  --text-color: #2C3E50;
  --border-color: #E1E8ED;
  --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
```

## 📱 Responsive Design

La aplicación está optimizada para:
- **Desktop** (1200px+): Layout completo con sidebar
- **Tablet** (768px-1199px): Adaptación de formularios y grids
- **Mobile** (<768px): Navegación hamburger y formularios simplificados

## 🔒 Seguridad

- **Validación CSRF** en todos los formularios
- **Sanitización de datos** en el backend
- **Validación de archivos** para imágenes
- **Protección reCAPTCHA** contra bots
- **Middleware de autenticación** en rutas protegidas
- **Middleware de roles** para acceso específico
- **Validación de sesiones** y control de acceso

## 🚀 Despliegue

### Producción
1. Configurar variables de entorno para producción
2. Ejecutar `npm run build` para compilar assets
3. Configurar servidor web (Apache/Nginx)
4. Configurar base de datos de producción
5. Configurar proveedor de email (SendGrid recomendado)

### Optimizaciones de Producción
```bash
# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## 📊 Base de Datos

### Tablas Principales
- **users**: Usuarios con roles (admin, sales, customer)
- **cars**: Vehículos con marca, modelo, año, imagen
- **password_reset_tokens**: Tokens para recuperación de contraseñas
- **migrations**: Control de versiones de base de datos

### Migraciones
```bash
# Ver estado de migraciones
php artisan migrate:status

# Ejecutar migraciones pendientes
php artisan migrate

# Revertir última migración
php artisan migrate:rollback
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

Para soporte técnico o preguntas:
- Email: info@automundo.mx
- Teléfono: +52 55 1234 5678

---

**Desarrollado con ❤️ usando Laravel 11** 