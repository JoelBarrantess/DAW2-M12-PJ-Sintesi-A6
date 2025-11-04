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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - FlowChat</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="imagen">
            <img src="./img/logo_cole" alt="Logo">
        </div>

        <div class="login-container">
            <h2>Iniciar sesión</h2>
            <form id="loginForm" method="post" action="proc/procesar_login.php" novalidate>
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required aria-describedby="usernameError"><br>
                <span class="error" id="usernameError" aria-live="polite"></span>
                <br>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required aria-describedby="passwordError"><br>
                <span class="error" id="passwordError" aria-live="polite"></span>
                <br>

                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
        </div>
    </div>

    <script src="./js/validacion_login.js"></script>
</body>
</html>
