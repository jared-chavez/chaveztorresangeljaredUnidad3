import "./bootstrap";

// === SweetAlert2 CDN loader ===
(function loadSweetAlert() {
    if (!window.Swal) {
        const script = document.createElement("script");
        script.src = "https://cdn.jsdelivr.net/npm/sweetalert2@11";
        script.async = true;
        document.head.appendChild(script);
    }
})();

// === Validation rules (exported for React components) ===
const deniedStrings = ["admin", "root", "test", "forbidden"]; // Example denied words

export function validateInput(input, form) {
    const type = input.getAttribute("data-type") || input.type;
    const value = input.value.trim();
    let valid = true,
        message = "";

    // Name: only letters (with accents), no numbers/special chars
    if (input.name === "name") {
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/.test(value)) {
            valid = false;
            message = "El nombre solo puede contener letras y espacios.";
        }
        if (input.hasAttribute("maxlength") && value.length > input.maxLength) {
            valid = false;
            message = `Máximo ${input.maxLength} caracteres.`;
        }
    } else if (type === "email") {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            valid = false;
            message = "Correo electrónico inválido.";
        }
        if (input.hasAttribute("maxlength") && value.length > input.maxLength) {
            valid = false;
            message = `Máximo ${input.maxLength} caracteres.`;
        }
    } else if (input.name === "password_confirmation") {
        const password = form.querySelector('input[name="password"]');
        if (password && value !== password.value) {
            valid = false;
            message = "Las contraseñas no coinciden.";
        }
    } else if (input.name === "password") {
        const confirmation = form.querySelector(
            'input[name="password_confirmation"]'
        );
        if (
            confirmation &&
            confirmation.value &&
            value !== confirmation.value
        ) {
            valid = false;
            message = "Las contraseñas no coinciden.";
        }
    } else if (
        type === "string" ||
        (type === "text" && !input.hasAttribute("data-type"))
    ) {
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/.test(value)) {
            valid = false;
            message = "Solo letras y espacios.";
        }
        if (input.hasAttribute("maxlength") && value.length > input.maxLength) {
            valid = false;
            message = `Máximo ${input.maxLength} caracteres.`;
        }
    } else if (type === "number") {
        const num = Number(value);
        if (isNaN(num)) {
            valid = false;
            message = "Debe ser un número válido.";
        }
        if (input.hasAttribute("min") && num < Number(input.min)) {
            valid = false;
            message = `El valor mínimo es ${input.min}.`;
        }
        if (input.hasAttribute("max") && num > Number(input.max)) {
            valid = false;
            message = `El valor máximo es ${input.max}.`;
        }
    }
    if (input.hasAttribute("required") && !value) {
        valid = false;
        message = "Este campo es obligatorio.";
    }
    return { valid, message };
}

export function showError(input, message) {
    input.classList.add("input-error");
    let error = input.parentNode.querySelector(".input-error-message");
    if (!error) {
        error = document.createElement("div");
        error.className = "input-error-message";
        error.style.color = "#d32f2f";
        error.style.fontSize = "0.95em";
        error.style.marginTop = "4px";
        input.parentNode.appendChild(error);
    }
    error.textContent = message;
    input.style.borderColor = "#d32f2f";
}

export function clearError(input) {
    input.classList.remove("input-error");
    let error = input.parentNode.querySelector(".input-error-message");
    if (error) error.remove();
    input.style.borderColor = "";
}

// === Add error border style ===
const style = document.createElement("style");
style.innerHTML = `
.input-error {
    border-color: #d32f2f !important;
}
`;
document.head.appendChild(style);

// === Login/Register Form Validation and Password Toggle ===
document.addEventListener('DOMContentLoaded', function() {
    // Helper: show error
    function showInputError(input, message) {
        input.classList.add('input-invalid');
        let error = input.parentNode.querySelector('.input-error');
        if (!error) {
            error = document.createElement('div');
            error.className = 'input-error';
            error.style.color = '#e60012';
            error.style.fontSize = '0.97em';
            error.style.marginTop = '2px';
            error.style.fontWeight = '500';
            error.style.letterSpacing = '0.1px';
        }
        error.textContent = message;
        // Insert error message directly after the input
        if (input.nextSibling) {
            input.parentNode.insertBefore(error, input.nextSibling);
        } else {
            input.parentNode.appendChild(error);
        }
    }
    // Helper: clear error
    function clearInputError(input) {
        input.classList.remove('input-invalid');
        let error = input.parentNode.querySelector('.input-error');
        if (error) error.remove();
    }
    // Validate register form
    const registerForm = document.querySelector('form[action$="register"]');
    if (registerForm) {
        // Add password toggle
        const passwordInput = registerForm.querySelector('#password');
        const confirmInput = registerForm.querySelector('#password_confirmation');
        if (passwordInput && confirmInput) {
            [passwordInput, confirmInput].forEach(function(input) {
                const wrapper = input.parentNode;
                const toggleBtn = document.createElement('button');
                toggleBtn.type = 'button';
                toggleBtn.className = 'form-btn-toggle';
                toggleBtn.style = 'position:absolute; right:18px; top:38px; background:none; border:none; cursor:pointer; color:#E60012; font-size:1.1em;';
                toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
                toggleBtn.setAttribute('aria-label', 'Mostrar/Ocultar contraseña');
                toggleBtn.addEventListener('click', function() {
                    input.type = input.type === 'password' ? 'text' : 'password';
                    toggleBtn.innerHTML = input.type === 'password' ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>';
                });
                wrapper.style.position = 'relative';
                wrapper.appendChild(toggleBtn);
            });
        }
        registerForm.addEventListener('submit', function(e) {
            let valid = true;
            // Validate all fields
            ['name','email','password','password_confirmation'].forEach(function(id) {
                const input = registerForm.querySelector('#'+id);
                clearInputError(input);
                if (!input.value.trim()) {
                    showInputError(input, 'Este campo es obligatorio.');
                    valid = false;
                } else if (id === 'email' && !/^\S+@\S+\.\S+$/.test(input.value.trim())) {
                    showInputError(input, 'Correo electrónico inválido.');
                    valid = false;
                } else if (id === 'password_confirmation') {
                    const pw = registerForm.querySelector('#password').value;
                    if (input.value !== pw) {
                        showInputError(input, 'Las contraseñas no coinciden.');
                        valid = false;
                    }
                }
            });
            if (!valid) e.preventDefault();
        });
        // Remove error on input
        ['name','email','password','password_confirmation'].forEach(function(id) {
            const input = registerForm.querySelector('#'+id);
            input.addEventListener('input', function() { clearInputError(input); });
        });
    }
    // Validate login form
    const loginForm = document.querySelector('form[action$="login"]');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            let valid = true;
            ['email','password'].forEach(function(id) {
                const input = loginForm.querySelector('#'+id);
                clearInputError(input);
                if (!input.value.trim()) {
                    showInputError(input, 'Este campo es obligatorio.');
                    valid = false;
                } else if (id === 'email' && !/^\S+@\S+\.\S+$/.test(input.value.trim())) {
                    showInputError(input, 'Correo electrónico inválido.');
                    valid = false;
                }
            });
            if (!valid) e.preventDefault();
        });
        ['email','password'].forEach(function(id) {
            const input = loginForm.querySelector('#'+id);
            input.addEventListener('input', function() { clearInputError(input); });
        });
    }
});
