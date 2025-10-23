<?php
session_start();
require_once 'conexion.php';

// Recibe usuario y contraseña por POST
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location: ../login.php?error=campos_vacios');
    exit;
}

try {
    // Buscar usuario en la BD
    $stmt = $conn->prepare('SELECT id_usuario, username, nombre, password_hash FROM tbl_usuarios WHERE username = :username LIMIT 1');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user || !password_verify($password, $user['password_hash'])) {
        header('Location: ../login.php?error=credenciales_invalidas');
        exit;
    }
    // Login correcto: guardar datos en sesión y permitir acceso a index.php
    $_SESSION['id_usuario'] = $user['id_usuario'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nombre'] = $user['nombre'];
    $_SESSION['loginok'] = true;
    header('Location: ../index.php');
    exit;
} catch (PDOException $e) {
    header('Location: ../login.php?error=error_bd');
    exit;
}
?>
