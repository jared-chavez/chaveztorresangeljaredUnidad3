<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registro</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
  <form action="process_register.php" method="POST">
    <h2>Crear cuenta</h2>
    <?php if (isset($_SESSION['error'])): ?>
      <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>
    
    <div class="g-recaptcha" data-sitekey="TU_SITE_KEY"></div>

    <button type="submit">Registrarse</button>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
  </form>
</body>
</html>
