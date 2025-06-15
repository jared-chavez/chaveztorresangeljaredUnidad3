<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error del servidor - 500</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            background: #fff;
            color: #222;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            max-width: 400px;
            margin: auto;
        }
        .error-code {
            font-size: 7em;
            font-weight: 900;
            letter-spacing: 2px;
            color: #222;
        }
        .error-message {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .error-desc {
            color: #555;
            margin-bottom: 30px;
        }
        .btn-orange {
            background: #ff9800;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            display: inline-block;
        }
        .btn-orange:hover {
            background: #e65100;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <div class="error-message">¡Vaya! Error interno del servidor</div>
        <div class="error-desc">Ha ocurrido un problema inesperado.<br>Por favor, intenta de nuevo más tarde o contacta al administrador.</div>
        <a href="{{ route('home') }}" class="btn-orange">Volver al inicio</a>
    </div>
</body>
</html>