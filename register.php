<?php
session_start();

// Si el usuario ya está autenticado, redirige a la página principal
if (isset($_SESSION["id_usuario"])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - FlowChat</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="imagen">
            <img src="./img/logo_cole" alt="Logo del centro">
        </div>

        <div class="login-container">
            <h2>Registro de usuario</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="error" style="color: #c0392b; font-size: 14px; text-align:center; margin-bottom: 15px;">
                    <?php
                    switch ($_GET['error']) {
                        case 'campos_vacios':
                            echo 'Por favor, completa todos los campos.';
                            break;
                        case 'usuario_existente':
                            echo 'El nombre de usuario o correo ya está en uso.';
                            break;
                        case 'error_bd':
                            echo 'Error al registrar el usuario.';
                            break;
                    }
                    ?>
                </div>
            <?php elseif (isset($_GET['ok'])): ?>
                <div class="success" style="color: #27ae60; font-size: 14px; text-align:center; margin-bottom: 15px;">
                    ✅ Registro completado. <a href="login.php" style="color:#0b518c; text-decoration:none;">Inicia sesión</a>
                </div>
            <?php endif; ?>

            <form method="post" action="proc/procesar_register.php">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="email">Correo</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Registrar</button>
            </form>

            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>
