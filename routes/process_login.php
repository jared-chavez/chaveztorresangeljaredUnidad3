<?php
session_start();
require 'config.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

if (!$email || !$password) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: login.php");
    exit;
}

// Buscar el usuario
$stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['error'] = "Credenciales incorrectas.";
    header("Location: login.php");
    exit;
}
?>
