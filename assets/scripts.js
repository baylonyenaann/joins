document.addEventListener('DOMContentLoaded', () => {
    function showForm(formId) {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        if (formId === 'login') {
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
        } else if (formId === 'register') {
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
        }
    }

    document.querySelectorAll('a[href="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const targetForm = anchor.getAttribute('onclick').split("'")[1];
            showForm(targetForm);
        });
    });

    showForm('login');
});
