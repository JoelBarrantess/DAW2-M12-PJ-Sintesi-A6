/* validacion_login.js
   Validación cliente para login.php
   Requisitos:
     - username: requerido, al menos 3 caracteres
     - password: requerido, al menos 6 caracteres
*/
(function() {
    'use strict';

    // Ejecutar cuando el DOM esté listo
    function init() {
        const form = document.getElementById('loginForm');
        if (!form) return;

        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        function clearError(el, errSpan) {
            if (!el || !errSpan) return;
            errSpan.textContent = '';
            el.classList.remove('input-error');
        }

        function showError(el, errSpan, message) {
            if (!el || !errSpan) return;
            errSpan.textContent = message;
            el.classList.add('input-error');
        }

        function validate() {
            let ok = true;
            const u = username.value.trim();
            const p = password.value;

            // Username: required, length >= 3
            clearError(username, usernameError);
            if (u.length === 0) {
                showError(username, usernameError, 'El usuario es obligatorio.');
                ok = false;
            } else if (u.length < 3) {
                showError(username, usernameError, 'El usuario debe tener al menos 3 caracteres.');
                ok = false;
            }

            // Password: required, length >= 6
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

        // Validate on submit
        form.addEventListener('submit', function(e) {
            if (!validate()) {
                e.preventDefault();
                // focus first invalid field
                const firstError = document.querySelector('.input-error');
                if (firstError) firstError.focus();
            }
        });

        // Real-time clearing of errors
        username.addEventListener('input', function() { clearError(username, usernameError); });
        password.addEventListener('input', function() { clearError(password, passwordError); });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
