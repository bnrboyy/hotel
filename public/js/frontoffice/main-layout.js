const menus = document.querySelectorAll('a.nav-link')
const pathURL = window.location.pathname;

menus.forEach(menu => {
    if (menu.getAttribute('data-slug') === pathURL) {
        menu.classList.add('nav-active', 'active')
    }

});
