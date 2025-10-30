<?php
session_start();

// Si el usuario ya está autenticado, mostrar página de inicio
if (isset($_SESSION["id_usuario"])) {
    header('Location: index.php');
    exit;
}

// Si no está autenticado, mostrar formulario de login (y posible mensaje de registro)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - FlowChat</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>

        <form method="post" action="proc/procesar_login.php">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
    </div>
</body>
</html>