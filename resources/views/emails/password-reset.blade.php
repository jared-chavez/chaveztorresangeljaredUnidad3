<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu contraseña - AutoMundo</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 32px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(31,38,135,0.08);
            padding: 32px 28px;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .header h1 {
            color: #007bff;
            margin: 0 0 8px 0;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
            margin: 24px 0;
        }
        .alert {
            background: #fff3cd;
            color: #856404;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 18px;
            border: 1px solid #ffeeba;
        }
        .footer {
            margin-top: 32px;
            text-align: center;
            color: #888;
            font-size: 0.95em;
        }
        .token-info {
            background: #f1f3f6;
            border-radius: 6px;
            padding: 10px;
            font-size: 0.95em;
            word-break: break-all;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Recupera tu contraseña</h1>
            <p>AutoMundo - Sistema de Gestión de Vehículos</p>
        </div>
        <p>Hola <strong>{{ $user->name }}</strong>,</p>
        <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en AutoMundo.</p>
        <div class="alert">
            <strong>⚠️ Importante:</strong> Si no solicitaste este cambio, puedes ignorar este correo de forma segura.
        </div>
        <div style="text-align: center;">
            <a href="{{ $url }}" class="btn">🔑 Restablecer Contraseña</a>
        </div>
        <p style="margin: 18px 0 0 0; color: #721c24;">
            <strong>⏰ Este enlace expira en 60 minutos.</strong><br>
            Por seguridad, el enlace dejará de funcionar después de este tiempo.
        </p>
        <p><strong>¿Problemas con el botón?</strong> Copia y pega este enlace en tu navegador:</p>
        <div class="token-info">{{ $url }}</div>
        <div class="footer">
            <p><strong>AutoMundo</strong> - Sistema de Gestión de Vehículos</p>
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html> 