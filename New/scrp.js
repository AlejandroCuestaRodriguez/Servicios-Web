document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profile-btn');
    const messagesBtn = document.getElementById('messages-btn');
    const notificationsBtn = document.getElementById('notifications-btn');
    const cartBtn = document.getElementById('cart-btn');
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementsByClassName('close')[0];
    const loginForm = document.getElementById('login-form');
    const registerLink = document.getElementById('register-link');

    let isLoggedIn = false;

    profileBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isLoggedIn) {
            alert('Mostrando perfil de usuario');
        } else {
            modal.style.display = 'block';
        }
    });

    messagesBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isLoggedIn) {
            alert('Mostrando mensajes');
        } else {
            alert('Por favor, inicia sesión para ver tus mensajes');
        }
    });

    notificationsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isLoggedIn) {
            alert('Mostrando notificaciones');
        } else {
            alert('Por favor, inicia sesión para ver tus notificaciones');
        }
    });

    cartBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isLoggedIn) {
            alert('Mostrando carrito de compras');
        } else {
            alert('Por favor, inicia sesión para acceder al carrito de compras');
        }
    });

    menuToggle.addEventListener('click', () => {
        mainNav.classList.toggle('active');
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
    });

    // Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', (e) => {
        const isClickInsideNav = mainNav.contains(e.target);
        const isClickOnToggle = menuToggle.contains(e.target);

        if (!isClickInsideNav && !isClickOnToggle && mainNav.classList.contains('active')) {
            mainNav.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Funcionalidad para agregar al carrito
    let cartItemCount = 0;
    const cartBadge = cartBtn.querySelector('.badge');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (isLoggedIn) {
                cartItemCount++;
                cartBadge.textContent = cartItemCount;
                alert('Producto agregado al carrito');
            } else {
                modal.style.display = 'block';
            }
        });
    });

    // Funcionalidad del modal de inicio de sesión
    closeBtn.onclick = () => {
        modal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    loginForm.onsubmit = (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Aquí iría la lógica de autenticación real
        if (username && password) {
            isLoggedIn = true;
            alert('Inicio de sesión exitoso');
            modal.style.display = 'none';
        } else {
            alert('Por favor, ingresa un usuario y contraseña válidos');
        }
    };

    registerLink.onclick = (e) => {
        e.preventDefault();
        alert('Redirigiendo a la página de registro');
        // Aquí iría la lógica para redirigir a la página de registro
    };
});