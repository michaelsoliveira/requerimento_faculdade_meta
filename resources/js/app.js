import './bootstrap';

//apresentar e ocultar a senha

window.togglePassword = function(fieldId, toggleIcon) {
    const field = document.getElementById(fieldId);
    const icon = toggleIcon.querySelector("i");

    if (field && icon) {
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            field.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
};
