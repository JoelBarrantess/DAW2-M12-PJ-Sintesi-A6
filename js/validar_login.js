function validarLogin() {
    var usuario = document.getElementById('username').value.trim();
    var contrasena = document.getElementById('password').value.trim();

    // Expresiones regulares para validaciones
    var regexUsuario = /^[a-zA-Z0-9_]{3,20}$/; // letras, números y guion bajo, de 3 a 20 caracteres
    var regexContrasena = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/; 
    // al menos una letra, un número y mínimo 6 caracteres

    // Validar campos vacíos
    if (usuario === "" || contrasena === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    // Validar formato del nombre de usuario
    if (!regexUsuario.test(usuario)) {
        alert("El nombre de usuario solo puede contener letras, números o guiones bajos (3-20 caracteres).");
        return false;
    }

    // Validar formato de la contraseña
    if (!regexContrasena.test(contrasena)) {
        alert("La contraseña debe tener al menos 6 caracteres, incluyendo una letra y un número.");
        return false;
    }

    // Evitar posibles inyecciones simples de código
    var caracteresProhibidos = /[<>"'%;(){}]/;
    if (caracteresProhibidos.test(usuario) || caracteresProhibidos.test(contrasena)) {
        alert("Se detectaron caracteres no permitidos. Revise sus datos.");
        return false;
    }

    return true; // Todo correcto
}
