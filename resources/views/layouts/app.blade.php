<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <?php header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); header('Pragma: no-cache'); header('Expires: 0'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoMundo - Tu Concesionario de Confianza')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('css/logo.png') }}">
</head>
<body data-user-role="{{ Auth::check() ? Auth::user()->role : 'guest' }}">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="top-bar-left">
                    <span><i class="fas fa-phone"></i> +52 55 1234 5678</span>
                    <span><i class="fas fa-envelope"></i> info@automundo.mx</span>
                </div>
                <div class="top-bar-right">
                    <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main-nav">
        <div class="container">
            <div class="nav-content">
                <div class="nav-logo">
                    <a href="{{ route('home') }}">
                        <div class="logo-container">
                            <div class="logo-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="logo-text">
                                <span class="logo-brand">AutoMundo</span>
                                <span class="logo-tagline">Tu Concesionario de Confianza</span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="nav-menu">
                    <a href="{{ route('home') }}" class="nav-link">Inicio</a>
                    
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <!-- Navegación para Administrador -->
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.users') }}" class="nav-link">
                                <i class="fas fa-users"></i> Usuarios
                            </a>
                            <a href="{{ route('admin.settings') }}" class="nav-link">
                                <i class="fas fa-cog"></i> Configuración
                            </a>
                        @elseif(Auth::user()->role === 'sales')
                            <!-- Navegación para Vendedor -->
                            <a href="{{ route('sales.dashboard') }}" class="nav-link">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                            <a href="{{ route('cars.index') }}" class="nav-link">
                                <i class="fas fa-car"></i> Vehículos
                            </a>
                        @elseif(Auth::user()->role === 'customer')
                            <!-- Navegación para Cliente -->
                            <a href="{{ route('customer.dashboard') }}" class="nav-link">
                                <i class="fas fa-user-circle"></i> Mi Panel
                            </a>
                            <a href="{{ route('cars.index') }}" class="nav-link">
                                <i class="fas fa-car"></i> Vehículos
                            </a>
                            <a href="{{ route('services') }}" class="nav-link">
                                <i class="fas fa-tools"></i> Servicios
                            </a>
                            <a href="{{ route('financiamiento') }}" class="nav-link">
                                <i class="fas fa-credit-card"></i> Financiamiento
                            </a>
                        @endif
                    @else
                        <!-- Navegación para usuarios no autenticados -->
                        <a href="{{ route('services') }}" class="nav-link">Servicios</a>
                        <a href="{{ route('financiamiento') }}" class="nav-link">Financiamiento</a>
                        <a href="{{ route('contact') }}" class="nav-link">Contacto</a>
                    @endauth
                </div>

                <div class="nav-actions">
                    @auth
                        <div class="user-menu" data-role="{{ Auth::user()->role }}">
                            <span class="user-greeting">
                                Hola, {{ Auth::user()->name ?? Auth::user()->email }}
                                <span class="user-role">{{ Auth::user()->getRoleDisplayName() }}</span>
                            </span>
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="fas fa-sign-out-alt"></i> Salir
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                    @endauth
                </div>

                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Enhanced Footer -->
    <footer class="site-footer">
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-section">
                        <div class="footer-logo">
                            <div class="logo-container">
                                <div class="logo-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="logo-text">
                                    <span class="logo-brand">AutoMundo</span>
                                    <span class="logo-tagline">Tu Concesionario de Confianza</span>
                                </div>
                            </div>
                        </div>
                        <p class="footer-description">
                            Más de 20 años de experiencia en el mercado automotriz, ofreciendo la mejor selección de vehículos y servicio al cliente de excelencia.
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <div class="footer-section">
                        <h3>Vehículos</h3>
                        <ul class="footer-links">
                            <li><a href="#">Nuevos</a></li>
                            <li><a href="#">Seminuevos</a></li>
                            <li><a href="#">Usados</a></li>
                            <li><a href="#">Financiamiento</a></li>
                            <li><a href="#">Seguros</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h3>Servicios</h3>
                        <ul class="footer-links">
                            <li><a href="#">Mantenimiento</a></li>
                            <li><a href="#">Reparaciones</a></li>
                            <li><a href="#">Diagnóstico</a></li>
                            <li><a href="#">Garantía</a></li>
                            <li><a href="#">Asistencia Vial</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h3>Contacto</h3>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Av. Insurgentes Sur 1234<br>Col. Del Valle, CDMX</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+52 55 1234 5678</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@automundo.mx</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; {{ date('Y') }} AutoMundo. Todos los derechos reservados.</p>
                    <div class="footer-legal">
                        <a href="#">Términos y Condiciones</a>
                        <a href="#">Política de Privacidad</a>
                        <a href="#">Aviso de Privacidad</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <style>
    .user-role {
        display: block;
        font-size: 0.8em;
        color: #667eea;
        font-weight: 500;
        margin-top: 2px;
    }
    
    .nav-link i {
        margin-right: 6px;
        width: 16px;
        text-align: center;
    }
    
    /* Estilos específicos por rol */
    .user-menu[data-role="admin"] .user-role {
        color: #dc3545;
    }
    
    .user-menu[data-role="sales"] .user-role {
        color: #007bff;
    }
    
    .user-menu[data-role="customer"] .user-role {
        color: #28a745;
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (navToggle) {
            navToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                navToggle.classList.toggle('active');
            });
        }

        // Logout confirmation
        const logoutForm = document.querySelector('.logout-form');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Cerrar sesión?',
                    text: '¿Estás seguro que deseas salir de tu cuenta?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Sí, cerrar sesión',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });
        }

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
    </script>
    @yield('scripts')
</body>
</html>
