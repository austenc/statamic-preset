// Import spotlight.js for lightboxes
import 'spotlight.js';

document.addEventListener('DOMContentLoaded', function() {
  let toggleBtn = document.getElementsByClassName('menu-toggle')[0];
  let menu = document.getElementsByClassName('navbar-menu')[0];

  toggleBtn.addEventListener('click', () => {
    toggleBtn.classList.toggle('is-active');
    menu.classList.toggle('hide');
  });
});
