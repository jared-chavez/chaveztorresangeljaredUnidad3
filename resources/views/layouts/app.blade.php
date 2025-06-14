<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shu1_dwp</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <nav style="background: #f0f0f0; padding: 10px; margin-bottom: 20px;">
        <span style="font-weight: bold; font-size: 1.2em; margin-right: 20px;">AutoMundo</span>

        <a href="{{ route('home') }}">Inicio</a> |
        <a href="{{ route('cars.index') }}">Autos</a> |
        <a href="{{ route('mailbox') }}">Buzón</a> |
        <a href="{{ route('help') }}">Ayuda</a> |
        <a href="{{ route('contact') }}">Contacto</a> |
        <a href="{{ route('sitemap') }}">Mapa del Sitio</a> |
        <a href="{{ route('password.recovery') }}">Recuperar Contraseña</a> |
        <a href="{{ route('chat') }}">Chat</a> |
        <a href="{{ route('search') }}">Buscar</a> |
        @auth
            <span style="margin-left: 10px;">Bienvenido, {{ Auth::user()->name ?? Auth::user()->email }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#007bff; cursor:pointer;">Cerrar sesión</button>
            </form>
        @else
            <a href="{{ route('register') }}">Registrar</a> |
            <a href="{{ route('login') }}">Iniciar Sesión</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>
</html>
