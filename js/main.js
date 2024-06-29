document.addEventListener('DOMContentLoaded', function() {
    console.log('Documento cargado y listo');
    
    const menuHamburguesa = document.querySelector('.menu-hamburguesa');
    const menu = document.querySelector('nav ul.menu');

    menuHamburguesa.addEventListener('click', () => {
        menu.classList.toggle('visible');
    });
});
