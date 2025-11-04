<?php
session_start();
require_once '../conexion/conexion.php';

$username = trim($_POST['username'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $nombre === '' || $apellido === '' || $email === '' || $password === '') {
    header('Location: ../register.php?error=campos_vacios');
    exit;
}

try {
    // Comprobar si el usuario ya existe
    $stmt = $conn->prepare('SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1');
    $stmt->execute([':username' => $username, ':email' => $email]);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existe) {
        header('Location: ../register.php?error=usuario_existente');
        exit;
    }

    // Crear hash seguro
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $stmt = $conn->prepare('
        INSERT INTO users (username, nombre, apellido, cargo, email, password_hash)
        VALUES (:username, :nombre, :apellido, 1, :email, :password_hash)
    ');
    $stmt->execute([
        ':username' => $username,
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':email' => $email,
        ':password_hash' => $password_hash
    ]);

    header('Location: ../register.php?ok=1');
    exit;

} catch (PDOException $e) {
    header('Location: ../register.php?error=error_bd');
    exit;
}
?>
