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
            <?php if (isset($_GET['error'])): ?>
                <div class="error" style="color: #c0392b; font-size: 14px; text-align:center; margin-bottom: 15px;">
                    <?php
                    switch ($_GET['error']) {
                        case 'campos_vacios':
                            echo 'Por favor, completa todos los campos.';
                            break;
                        case 'credenciales_invalidas':
                            echo 'Usuario o contraseña incorrectos.';
                            break;
                        case 'usuario_corto':
                            echo 'El nombre de usuario es demasiado corto (mín. 3 caracteres).';
                            break;
                        case 'password_corto':
                            echo 'La contraseña es demasiado corta (mín. 6 caracteres).';
                            break;
                        case 'error_bd':
                            echo 'Error de servidor. Intenta más tarde.';
                            break;
                        default:
                            echo 'Error en el inicio de sesión.';
                            break;
                    }
                    ?>
                </div>
            <?php endif; ?>

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
