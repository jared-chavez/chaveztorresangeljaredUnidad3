<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nuevo mensaje de contacto</title>
</head>
<body style="background:#f5f7fa;padding:32px 0;font-family:'Poppins',Arial,sans-serif;">
  <div style="max-width:480px;margin:0 auto;background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(31,38,135,0.08);padding:32px 28px;">
    <h2 style="color:#007bff;margin-bottom:18px;">Nuevo mensaje de contacto</h2>
    <table style="width:100%;margin-bottom:18px;font-size:1em;">
      <tr><td style="padding:6px 0;"><strong>Nombre:</strong></td><td style="padding:6px 0;">{{ $name }}</td></tr>
      <tr><td style="padding:6px 0;"><strong>Email:</strong></td><td style="padding:6px 0;">{{ $email }}</td></tr>
      <tr><td style="padding:6px 0;"><strong>Teléfono:</strong></td><td style="padding:6px 0;">{{ $phone }}</td></tr>
      <tr><td style="padding:6px 0;"><strong>Asunto:</strong></td><td style="padding:6px 0;">{{ $subject }}</td></tr>
    </table>
    <div style="margin-bottom:18px;">
      <div style="font-weight:600;color:#222;margin-bottom:6px;">Mensaje:</div>
      <div style="background:#f5f7fa;border-radius:8px;padding:16px 14px;color:#333;line-height:1.6;white-space:pre-line;">{{ $messageContent }}</div>
    </div>
    <div style="margin-top:32px;font-size:0.95em;color:#888;text-align:center;">AutoMundo - Notificación automática</div>
  </div>
</body>
</html> 