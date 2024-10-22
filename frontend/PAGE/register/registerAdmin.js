import SesionDao from '../../DAO/sesionDAO.js';

window.onload = () => {
    let registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            let correo = document.getElementById('correo').value;
            let password = document.getElementById('contraseña').value;
            let nombre = document.getElementById('nombre').value;
            let apellido = document.getElementById('apellido').value;

            let sesionDao = new SesionDao();
            await sesionDao.registerAdmin(correo, password, nombre, apellido);
        });
    } else {
        console.error("El formulario 'registerForm' no se encontró en el DOM.");
    }
};

