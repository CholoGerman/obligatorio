import SesionDao from '../../DAO/sesionDAO.js';

window.onload = () => {
    let loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
    
            let correo = document.getElementById('correo').value.trim();
            let password = document.getElementById('contraseña').value.trim();
    
            if (!correo || !password) {
                alert("Correo y contraseña son obligatorios.");
                return;
            }
    
            let sesionDao = new SesionDao();
            let respuesta = await sesionDao.login(correo, password);
            console.log("Respuesta del servidor:", respuesta);
          

            if (respuesta.status) {
                sessionStorage.setItem('usuarioId', respuesta.datos.id_persona); // Guarda el ID de la persona
    
                // Verifica si es un administrador
                if (respuesta.datos.isAdmin) {
                    // Redirige a la página de administrador
                    window.location.href = "http://localhost/obligatorio/frontend/PAGE/admin/controlador_Admin.html";
                } else {
                    // Redirige a la página de inicio normal
                    window.location.href = "http://localhost/obligatorio/frontend/PAGE/inicio/index.html";
                }
            } else {
                alert(respuesta.mensaje);
            }
        });
    }
    
    
}


