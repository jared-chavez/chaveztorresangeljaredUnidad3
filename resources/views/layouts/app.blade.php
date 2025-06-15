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
        <span class="navbar-logo">AutoMundo</span>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('cars.index') }}">Autos</a>
            <a href="{{ route('contact') }}">Contacto</a>
            <a href="{{ route('sitemap') }}">Mapa del Sitio</a>
            <a href="{{ route('password.recovery') }}">Recuperar Contraseña</a>
            @auth
                <span class="navbar-user">Bienvenido, {{ Auth::user()->name ?? Auth::user()->email }}</span>
                <form action="{{ route('logout') }}" method="POST" class="navbar-logout">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('register') }}">Registrar</a>
                <a href="{{ route('login') }}">Iniciar Sesión</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>
</html>
