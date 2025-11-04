/* validacion_register.js
   Validación cliente para register.php
   Requisitos:
     - username: requerido, al menos 3 caracteres
     - nombre: requerido, al menos 2 caracteres
     - apellido: requerido, al menos 2 caracteres
     - email: requerido, formato básico de email
     - password: requerido, al menos 6 caracteres
*/
(function() {
    'use strict';

    function isValidEmail(email) {
        // Simple regex adecuado para validación básica en cliente
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function init() {
        const form = document.getElementById('registerForm');
        if (!form) return;

        const username = document.getElementById('username');
        const nombre = document.getElementById('nombre');
        const apellido = document.getElementById('apellido');
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        const usernameError = document.getElementById('usernameError');
        const nombreError = document.getElementById('nombreError');
        const apellidoError = document.getElementById('apellidoError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        function clearError(el, errSpan) {
            if (!el || !errSpan) return;
            errSpan.textContent = '';
            el.classList.remove('input-error');
        }

        function showError(el, errSpan, msg) {
            if (!el || !errSpan) return;
            errSpan.textContent = msg;
            el.classList.add('input-error');
        }

        function validate() {
            let ok = true;

            const u = username.value.trim();
            const n = nombre.value.trim();
            const a = apellido.value.trim();
            const e = email.value.trim();
            const p = password.value;

            clearError(username, usernameError);
            if (u.length === 0) {
                showError(username, usernameError, 'El usuario es obligatorio.');
                ok = false;
            } else if (u.length < 3) {
                showError(username, usernameError, 'El usuario debe tener al menos 3 caracteres.');
                ok = false;
            }

            clearError(nombre, nombreError);
            if (n.length === 0) {
                showError(nombre, nombreError, 'El nombre es obligatorio.');
                ok = false;
            } else if (n.length < 2) {
                showError(nombre, nombreError, 'Introduce al menos 2 caracteres para el nombre.');
                ok = false;
            }

            clearError(apellido, apellidoError);
            if (a.length === 0) {
                showError(apellido, apellidoError, 'El apellido es obligatorio.');
                ok = false;
            } else if (a.length < 2) {
                showError(apellido, apellidoError, 'Introduce al menos 2 caracteres para el apellido.');
                ok = false;
            }

            clearError(email, emailError);
            if (e.length === 0) {
                showError(email, emailError, 'El correo es obligatorio.');
                ok = false;
            } else if (!isValidEmail(e)) {
                showError(email, emailError, 'Introduce un correo electrónico válido.');
                ok = false;
            }

            clearError(password, passwordError);
            if (p.length === 0) {
                showError(password, passwordError, 'La contraseña es obligatoria.');
                ok = false;
            } else if (p.length < 6) {
                showError(password, passwordError, 'La contraseña debe tener al menos 6 caracteres.');
                ok = false;
            }

            return ok;
        }

        form.addEventListener('submit', function(e) {
            if (!validate()) {
                e.preventDefault();
                const firstErr = document.querySelector('.input-error');
                if (firstErr) firstErr.focus();
            }
        });

        // Clear errors while user types
        [username, nombre, apellido, email, password].forEach(function(el) {
            if (!el) return;
            const err = document.getElementById(el.id + 'Error');
            el.addEventListener('input', function() { clearError(el, err); });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
