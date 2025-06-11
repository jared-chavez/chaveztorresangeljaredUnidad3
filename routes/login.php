<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <form action="process_login.php" method="POST">
    <h2>Iniciar sesión</h2>
    <?php if (isset($_SESSION['error'])): ?>
      <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Ingresar</button>
    <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
  </form>
</body>
</html>
