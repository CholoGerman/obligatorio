import SesionDao from '../../DAO/sesionDAO.js';

window.onload = () => {
    let loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            let correo = document.getElementById('correo').value;
            let password = document.getElementById('contraseña').value;

            let sesionDao = new SesionDao();
            await sesionDao.login(correo, password);
        });
    } else {
        console.error("El formulario 'loginForm' no se encontró en el DOM.");
    }
};

