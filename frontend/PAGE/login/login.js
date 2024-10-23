import SesionDao from '../../DAO/sesionDAO.js';

window.onload = () => {
    let loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
        
            let correo = document.getElementById('correo').value;
            let password = document.getElementById('contraseña').value;
        
            let sesionDao = new SesionDao();
            let respuesta = await sesionDao.login(correo, password);

            // Cambia respuestaJson a respuesta
            console.log(respuesta); // Muestra la respuesta correcta

            if (respuesta.status) {
                sessionStorage.setItem('usuarioId', respuesta.datos.id_persona); // Asegúrate de que "id_persona" esté en la respuesta
                // Redirigir o realizar otras acciones necesarias
                window.location.href = 'http://localhost/obligatorio/frontend/PAGE/inicio/index.html';
            } else {
                alert(respuesta.mensaje); // Muestra el mensaje de error
            }
        });
    }
}


