document.addEventListener('DOMContentLoaded', () => {
    const mensaje = document.getElementById('mensaje-flash');
    if (mensaje) {
        setTimeout(() => mensaje.remove(), 5000);
        mensaje.querySelector('.cerrar-mensaje').addEventListener('click', () => mensaje.remove());
    }
});
