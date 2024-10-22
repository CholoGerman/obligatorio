import SesionDao from '../../DAO/sesionDAO.js'; // Importa la clase SesionDao desde el archivo especificado

// Función que se ejecuta cuando la ventana se ha cargado completamente
window.onload = () => {
    let registerForm = document.getElementById('registerForm'); // Obtiene el formulario de registro por su ID

    // Verifica si el formulario existe en el DOM
    if (registerForm) {
        // Agrega un evento que se activa al enviar el formulario
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Previene el comportamiento predeterminado del formulario

            // Captura los valores de los campos del formulario
            let correo = document.getElementById('correo').value; // Correo del administrador
            let password = document.getElementById('contraseña').value; // Contraseña del administrador
            let nombre = document.getElementById('nombre').value; // Nombre del administrador
            let apellido = document.getElementById('apellido').value; // Apellido del administrador

            // Crea una nueva instancia de SesionDao
            let sesionDao = new SesionDao();
            // Llama al método de registro de administrador con los datos capturados
            await sesionDao.registerAdmin(correo, password, nombre, apellido);
        });
    } else {
        // Mensaje de error si el formulario no se encuentra en el DOM
        console.error("El formulario 'registerForm' no se encontró en el DOM.");
    }
};
