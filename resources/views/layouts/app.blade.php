<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMundo</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-logo" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #007bff;">
            <span>AutoMundo</span>
            <span class="footer-icon" style="display: inline-block; vertical-align: middle;">
                <!-- Simple SVG car icon (copied from footer) -->
                <svg width="32" height="22" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="10" width="30" height="7" rx="2" fill="#ff9800"/>
                    <rect x="7" y="6" width="22" height="7" rx="2" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                    <circle cx="9" cy="19" r="3" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                    <circle cx="27" cy="19" r="3" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                </svg>
            </span>
        </a>
        <div class="navbar-links">
            <a href="{{ route('sitemap') }}">Mapa del Sitio</a>
            <a href="{{ route('password.recovery') }}">Recuperar Contraseña</a>
            @auth
                <span class="navbar-user">Bienvenido, {{ Auth::user()->name ?? Auth::user()->email }}</span>
                <form action="{{ route('logout') }}" method="POST" class="navbar-logout">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="btn">Registrar</a>
                <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <span class="footer-logo">
                <span class="footer-icon">
                    <!-- Simple SVG car icon -->
                    <svg width="36" height="24" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="10" width="30" height="7" rx="2" fill="#ff9800"/>
                        <rect x="7" y="6" width="22" height="7" rx="2" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                        <circle cx="9" cy="19" r="3" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                        <circle cx="27" cy="19" r="3" fill="#fff" stroke="#ff9800" stroke-width="2"/>
                    </svg>
                </span>
                <span class="footer-brand">AutoMundo</span>
            </span>
            <span class="footer-info">© {{ date('Y') }} AutoMundo. Todos los derechos reservados.</span>
            <span class="footer-contact">Contacto: angeljaredchaveztorres@gmail.com</span>
        </div>
    </footer>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutForm = document.querySelector('.navbar-logout');
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
    });
    </script>
    @yield('scripts')
</body>
</html>
