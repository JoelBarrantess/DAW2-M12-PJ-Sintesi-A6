<?php
session_start();

// Comprobar si el usuario está logueado correctamente
if (isset($_SESSION['loginok']) && $_SESSION['loginok'] === true && isset($_SESSION['username'])) {
    $nombre = htmlspecialchars($_SESSION['nombre']);
    $username = htmlspecialchars($_SESSION['username']);
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="wrapper" style="flex-direction: column; text-align: center;">
        <div class="login-container" style="width: 400px;">
            <h2>Bienvenido 👋</h2>
            <p><strong>Nombre:</strong> <?= $nombre ?></p>
            <p><strong>Usuario:</strong> <?= $username ?></p>

            <form method="post" action="logout.php">
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
