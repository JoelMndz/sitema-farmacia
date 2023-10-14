let darkModeIcon = document.querySelector('#dark_mode');
let isDarkMode = localStorage.getItem('darkMode') === 'true';

// Elemento de imagen que deseas cambiar según el modo
let iconImage = document.querySelector('.brand-link .brand-image');
let sloganImage = document.querySelector('#img-slogan');
let carritoImage = document.querySelector('#navbarDropdown');

// Establecer el modo inicial según el almacenamiento local
if (isDarkMode) {
  document.body.classList.add('dark-mode-color');
  darkModeIcon.src = '../img/sun2.png';
  // Cambia la ruta de la imagen según el modo oscuro
  iconImage.src = '../img/icon1.png'; // Ruta de la imagen en modo oscuro
  sloganImage.src = '../img/slogan-dark.png';
  carritoImage.src = '../img/carrito.png';
} else {
  document.body.classList.remove('dark-mode-color');
  darkModeIcon.src = '../img/moon.png';
  // Cambia la ruta de la imagen según el modo claro
  iconImage.src = '../img/icon-dark.png'; // Ruta de la imagen en modo claro
  sloganImage.src = '../img/slogan.png'; 
  carritoImage.src = '../img/carrito2.png';
}

darkModeIcon.onclick = () => {
  document.body.classList.toggle('dark-mode-color');
  isDarkMode = !isDarkMode;

  // Guardar el modo actual en el almacenamiento local
  localStorage.setItem('darkMode', isDarkMode);

  // Cambiar la imagen del modo oscuro/claro
  if (isDarkMode) {
    darkModeIcon.src = '../img/sun2.png';  // Cambiar a la imagen de modo claro
    // Cambia la ruta de la imagen según el modo oscuro
    iconImage.src = '../img/icon1.png'; // Ruta de la imagen en modo oscuro
    sloganImage.src = '../img/slogan-dark.png';
    carritoImage.src = '../img/carrito.png';
  } else {
    darkModeIcon.src = '../img/moon.png'; // Cambiar a la imagen de modo oscuro
    // Cambia la ruta de la imagen según el modo claro
    iconImage.src = '../img/icon-dark.png'; // Ruta de la imagen en modo claro
    sloganImage.src = '../img/slogan.png';
    carritoImage.src = '../img/carrito2.png';
  }
}
