import SesionDao from '../../DAO/sesionDAO.js'; // Importa la clase SesionDao desde el archivo especificado

// Función que se ejecuta cuando la ventana se ha cargado completamente
window.onload = () => {
    let registroForm = document.getElementById('registroForm'); // Obtiene el formulario de registro por su ID

    // Verifica si el formulario existe en el DOM
    if (registroForm) {
        // Agrega un evento que se activa al enviar el formulario
        registroForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Previene el comportamiento predeterminado del formulario

            // Captura los valores de los campos del formulario
            let nombre = document.getElementById('nombre').value; // Nombre del usuario
            let apellido = document.getElementById('apellido').value; // Apellido del usuario
            let correo = document.getElementById('correo').value; // Correo del usuario
            let password = document.getElementById('contraseña').value; // Contraseña del usuario
            let re_password = document.getElementById('re_contraseña').value; // Repetición de la contraseña

            // Verifica si las contraseñas ingresadas coinciden
            if (password !== re_password) {
                alert("Las contraseñas no coinciden"); // Mensaje de alerta si no coinciden
                return; // Sale de la función si las contraseñas no coinciden
            }

            let sesionDao = new SesionDao(); // Crea una nueva instancia de SesionDao
            await sesionDao.register(correo, password, nombre, apellido); // Llama al método de registro
        });
    } else {
        console.error("El formulario 'registroForm' no se encontró en el DOM."); // Mensaje de error si el formulario no se encuentra
    }
};

