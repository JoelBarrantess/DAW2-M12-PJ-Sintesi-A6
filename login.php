<?php
session_start();

// Mostrar mensaje de error si viene por parámetro
$error = $_GET['error'] ?? '';
$msgerror = '';
switch ($error) {
    case 'campos_vacios':
        $msgerror = 'Por favor, complete todos los campos.';
        break;
    case 'credenciales_invalidas':
        $msgerror = 'Usuario o contraseña incorrectos.';
        break;
    case 'error_bd':
        $msgerror = 'Error en la base de datos.';
        break;
}

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
    <title>Login Escuela</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/validar_login.js"></script> <!-- Archivo externo -->
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <?php if ($msgerror): ?>
            <p class="msg-error"><strong><?= htmlspecialchars($msgerror) ?></strong></p>
        <?php endif; ?>

        <!-- Llamada a la función JS externa -->
        <form method="post" action="proc/procesar_login.php" onsubmit="return validarLogin();">
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
