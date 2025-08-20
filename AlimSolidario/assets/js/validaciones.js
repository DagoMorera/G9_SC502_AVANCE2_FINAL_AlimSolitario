document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.querySelector("form");

    formulario.addEventListener("submit", function(e) {
        const nombre = document.getElementById("nombre").value;
        const correo = document.getElementById("correo").value;
        const contraseña = document.getElementById("contraseña").value;
        
        if (!nombre || !correo || !contraseña) {
            alert("Todos los campos son obligatorios.");
            e.preventDefault();  // Evitar el envío del formulario
        }
    });
});
