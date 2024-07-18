// script.js

// Fonction pour ouvrir/fermer le menu en forme de tiroir
function toggleDrawerMenu() {
    const drawerMenu = document.querySelector('.drawer-menu');
    drawerMenu.classList.toggle('open');
}

// Écouteur d'événement pour l'icône du menu
const menuIcon = document.querySelector('.menu-icon');
menuIcon.addEventListener('click', toggleDrawerMenu);
