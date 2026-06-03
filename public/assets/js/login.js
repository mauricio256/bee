document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('loginForm');

    if(!form) return;

    form.addEventListener('submit', () => {

        const loader = document.getElementById('loader');
        const btn = document.getElementById('btnLogin');

        btn.disabled = true;
        btn.innerText = 'Entrando...';

        loader.style.display = 'flex';

    });

});