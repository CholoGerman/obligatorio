import SesionDao from '../../DAO/sesionDAO.js'; // Importa la clase SesionDao desde el archivo especificado

// Función que se ejecuta cuando la ventana se ha cargado completamente
window.onload = () => {
    let registerForm = document.getElementById('registerForm'); // Obtiene el formulario de registro por su ID

    // Verifica si el formulario existe en el DOM
    if (registerForm) {
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();
    
            let correo = document.getElementById('correo').value.trim();
            let password = document.getElementById('contraseña').value.trim();
            let nombre = document.getElementById('nombre').value.trim();
            let apellido = document.getElementById('apellido').value.trim();
    
            // Validación básica
            if (!correo || !password || !nombre || !apellido) {
                alert("Todos los campos son obligatorios.");
                return;
            }
    
            let sesionDao = new SesionDao();
            await sesionDao.registerAdmin(correo, password, nombre, apellido);
        });
    }
    
};
