// Objetivo: Efecto de cristal en el menú de navegación
// Función para detectar el desplazamiento
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar"); // Seleccionar el menú
    if (window.scrollY > 50) { // Si se ha desplazado más de 50px
        navbar.classList.add("glass"); // Aplicar el efecto de cristal
    } else {
        navbar.classList.remove("glass"); // Quitar el efecto si está cerca de la parte superior
    }
});
 


