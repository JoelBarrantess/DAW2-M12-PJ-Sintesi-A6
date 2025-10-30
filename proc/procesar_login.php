<?php
session_start();
// Incluir la conexión PDO. Ajusta la ruta si es necesario.
require_once __DIR__ . '/../conexion/conexion.php';

// Recibe usuario y contraseña por POST
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    header('Location: ../login.php?error=campos_vacios');
    exit;
}

try {
    // Buscar usuario en la tabla `users` (según BBDD.sql)
    $stmt = $conn->prepare('SELECT id, username, nombre, password_hash FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password_hash'])) {
        header('Location: ../login.php?error=credenciales_invalidas');
        exit;
    }

    // Login correcto: guardar datos en sesión y permitir acceso a index.php
    $_SESSION['id_usuario'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nombre'] = $user['nombre'];
    $_SESSION['loginok'] = true;
    header('Location: ../index.php');
    exit;
} catch (PDOException $e) {
    // En caso de error de BD, redirigir con código de error
    header('Location: ../login.php?error=error_bd');
    exit;
}
?>
