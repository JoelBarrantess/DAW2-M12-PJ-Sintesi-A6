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
