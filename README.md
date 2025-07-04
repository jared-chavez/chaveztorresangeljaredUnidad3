# 🚗 AutoMundo - Sistema de Gestión de Vehículos

<p align="center">
  <img src="https://img.icons8.com/ios-filled/100/007bff/car.png" alt="AutoMundo Logo" width="100">
  <br>
  <strong>Sistema de Gestión de Vehículos con Laravel</strong>
</p>

## 📋 Descripción

AutoMundo es una aplicación web completa para la gestión de vehículos desarrollada con Laravel. Permite a los usuarios administrar un inventario de autos con funcionalidades de creación, edición, eliminación y búsqueda de vehículos.

## ✨ Características Principales

### 🔐 Sistema de Autenticación
- **Registro de usuarios** con validación de datos
- **Inicio de sesión** seguro con reCAPTCHA
- **Recuperación de contraseñas** por email
- **Protección de rutas** con middleware de autenticación

### 🚗 Gestión de Vehículos
- **CRUD completo** de vehículos (Crear, Leer, Actualizar, Eliminar)
- **Búsqueda en tiempo real** por marca y modelo
- **Carga de imágenes** para cada vehículo
- **Validación de formularios** en frontend y backend
- **Interfaz responsiva** con animaciones suaves

### 🎨 Interfaz de Usuario
- **Diseño moderno** con Tailwind CSS
- **Animaciones fluidas** para mejor experiencia de usuario
- **Notificaciones interactivas** con SweetAlert2
- **Responsive design** para móviles y tablets

### 🛠️ Tecnologías Utilizadas
- **Backend:** Laravel 11 (PHP)
- **Frontend:** JavaScript vanilla, Tailwind CSS
- **Base de datos:** SQLite
- **Autenticación:** Laravel Breeze
- **Validación:** reCAPTCHA v2

## 🚀 Instalación

### Requisitos Previos
- PHP 8.1 o superior
- Composer
- Node.js y npm
- Git

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd u2dwp_sh
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

7. **Compilar assets**
   ```bash
   npm run build
   ```

8. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

## 📁 Estructura del Proyecto

```
u2dwp_sh/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/CarController.php    # API para gestión de vehículos
│   │   ├── AuthController.php       # Controlador de autenticación
│   │   ├── ContactController.php    # Controlador de contacto
│   │   └── PasswordResetController.php
│   ├── Models/
│   │   ├── Car.php                  # Modelo de vehículos
│   │   └── User.php                 # Modelo de usuarios
│   └── Rules/
│       └── Recaptcha.php           # Regla de validación reCAPTCHA
├── resources/
│   ├── js/
│   │   ├── app.js                  # JavaScript principal
│   │   ├── cars-ajax.js            # Lógica de gestión de vehículos
│   │   ├── ajax-app.js             # Funciones de prueba AJAX
│   │   └── services/
│   │       └── carApi.js           # Servicio API de vehículos
│   ├── css/
│   │   └── app.css                 # Estilos principales
│   └── views/
│       ├── cars.blade.php          # Vista principal de vehículos
│       ├── cars-ajax.blade.php     # Vista de pruebas AJAX
│       ├── auth/                   # Vistas de autenticación
│       └── layouts/
│           └── app.blade.php       # Layout principal
└── routes/
    └── web.php                     # Rutas de la aplicación
```

## 🎯 Funcionalidades Detalladas

### Gestión de Vehículos
- **Agregar vehículo:** Formulario con validación de marca, modelo, año e imagen
- **Editar vehículo:** Modificación de datos existentes
- **Eliminar vehículo:** Confirmación antes de eliminar
- **Buscar vehículos:** Filtrado en tiempo real
- **Vista de tarjetas:** Presentación visual de vehículos

### Sistema de Autenticación
- **Registro:** Validación de email, contraseña y reCAPTCHA
- **Login:** Autenticación segura con redirección
- **Logout:** Cierre de sesión seguro
- **Recuperación:** Envío de email para reset de contraseña

### API REST
- **GET /api/cars** - Obtener todos los vehículos
- **POST /api/cars** - Crear nuevo vehículo
- **PUT /api/cars/{id}** - Actualizar vehículo
- **DELETE /api/cars/{id}** - Eliminar vehículo

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

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

RECAPTCHA_SITE_KEY=tu_clave_del_sitio
RECAPTCHA_SECRET_KEY=tu_clave_secreta
```

### reCAPTCHA
Para habilitar reCAPTCHA:
1. Registrarse en [Google reCAPTCHA](https://www.google.com/recaptcha/)
2. Obtener las claves pública y secreta
3. Configurar en el archivo `.env`

## 🧪 Pruebas

### Interfaz de Pruebas AJAX
Accede a `/cars-ajax` para probar todas las funciones de la API:
- Crear vehículos de prueba
- Actualizar datos existentes
- Eliminar vehículos
- Probar todas las operaciones CRUD

### Comandos de Artisan
```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Crear seeders (si existen)
php artisan db:seed

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 🎨 Personalización

### Estilos CSS
Los estilos principales se encuentran en:
- `resources/css/app.css` - Estilos con Tailwind CSS
- `public/css/styles.css` - Estilos personalizados

### JavaScript
La lógica principal está en:
- `resources/js/cars-ajax.js` - Gestión de vehículos
- `resources/js/app.js` - Validaciones y utilidades

## 📱 Responsive Design

La aplicación está optimizada para:
- **Desktop:** Pantallas grandes con layout completo
- **Tablet:** Adaptación de formularios y grids
- **Mobile:** Navegación optimizada y formularios simplificados

## 🔒 Seguridad

- **Validación CSRF** en todos los formularios
- **Sanitización de datos** en el backend
- **Validación de archivos** para imágenes
- **Protección reCAPTCHA** contra bots
- **Middleware de autenticación** en rutas protegidas

## 🚀 Despliegue

### Producción
1. Configurar variables de entorno para producción
2. Ejecutar `npm run build` para compilar assets
3. Configurar servidor web (Apache/Nginx)
4. Configurar base de datos de producción

### Docker (Opcional)
```dockerfile
FROM php:8.2-fpm
# Configuración de Docker para producción
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
- Crear un issue en GitHub
- Contactar al equipo de desarrollo

---

**Desarrollado con ❤️ usando Laravel** 