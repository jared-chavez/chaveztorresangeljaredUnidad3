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
    <nav>
        <!-- Tu menú de navegación irá aquí -->
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('autos.index') }}">Autos</a>
        <a href="{{ route('autos.create') }}">Registrar Auto</a>
        <!-- Otros links... -->
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
