import SesionDao from '../../DAO/sesionDAO.js';


window.onload = () => {
    let registroForm = document.getElementById('registroForm');

    if (registroForm) {
        registroForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            let nombre = document.getElementById('nombre').value;
            let apellido = document.getElementById('apellido').value;
            let correo = document.getElementById('correo').value;
            let password = document.getElementById('contraseña').value;
            let re_password = document.getElementById('re_contraseña').value;

            if (password !== re_password) {
                alert("Las contraseñas no coinciden");
                return;
            }

            let sesionDao = new SesionDao();
            await sesionDao.register(correo, password, nombre, apellido);
        });
    } else {
        console.error("El formulario 'registroForm' no se encontró en el DOM.");
    }
};

