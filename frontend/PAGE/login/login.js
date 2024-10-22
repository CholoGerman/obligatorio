import SesionDao from '../../DAO/sesionDAO.js'; // Importa la clase SesionDao desde el archivo especificado

// Función que se ejecuta cuando la ventana se ha cargado completamente
window.onload = () => {
    let loginForm = document.getElementById('loginForm'); // Obtiene el formulario de inicio de sesión por su ID

    // Verifica si el formulario existe en el DOM
    if (loginForm) {
        // Agrega un evento que se activa al enviar el formulario
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Previene el comportamiento predeterminado del formulario

            // Captura los valores de los campos del formulario
            let correo = document.getElementById('correo').value; // Correo del usuario
            let password = document.getElementById('contraseña').value; // Contraseña del usuario

            // Crea una nueva instancia de SesionDao
            let sesionDao = new SesionDao();
            // Llama al método de inicio de sesión con los datos capturados
            await sesionDao.login(correo, password);
        });
    } else {
        // Mensaje de error si el formulario no se encuentra en el DOM
        console.error("El formulario 'loginForm' no se encontró en el DOM.");
    }
};

