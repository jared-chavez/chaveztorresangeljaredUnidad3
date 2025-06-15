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

// === Validation rules ===
const deniedStrings = ["admin", "root", "test", "forbidden"]; // Example denied words

function validateInput(input, form) {
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

function showError(input, message) {
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

function clearError(input) {
    input.classList.remove("input-error");
    let error = input.parentNode.querySelector(".input-error-message");
    if (error) error.remove();
    input.style.borderColor = "";
}

// Attach validation to all forms
window.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form").forEach((form) => {
        form.addEventListener("submit", function (e) {
            let hasError = false;
            form.querySelectorAll("input, textarea").forEach((input) => {
                clearError(input);
                const { valid, message } = validateInput(input, form);
                if (!valid) {
                    showError(input, message);
                    hasError = true;
                }
            });
            if (hasError) {
                e.preventDefault();
                if (window.Swal) {
                    Swal.fire({
                        icon: "error",
                        title: "Error en el formulario",
                        text: "Por favor corrige los errores antes de continuar.",
                    });
                } else {
                    alert("Por favor corrige los errores antes de continuar.");
                }
                return false;
            } else {
                // Show SweetAlert on submit (success)
                if (window.Swal) {
                    Swal.fire({
                        icon: "success",
                        title: "Formulario enviado",
                        text: "¡Tu información ha sido enviada correctamente!",
                    });
                }
                // Optionally, you can prevent default and only submit after user closes modal
                // e.preventDefault();
                // setTimeout(() => form.submit(), 1000);
            }
        });
        // Real-time validation
        form.querySelectorAll("input, textarea").forEach((input) => {
            input.addEventListener("input", function () {
                clearError(input);
                const { valid, message } = validateInput(input, form);
                if (!valid) {
                    showError(input, message);
                }
            });
        });
    });
});

// === Add error border style ===
const style = document.createElement("style");
style.innerHTML = `
.input-error {
    border-color: #d32f2f !important;
}
`;
document.head.appendChild(style);
