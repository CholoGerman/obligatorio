import SesionDao from '../../DAO/sesionDAO.js';
//Importa la clase sessionDAO que se encarga de hacer las peticiones
//Al servidor

//Se ejecuta cuando la pagina se cargue por completo
window.onload = () => {

    //Encuentra el login de formulario en DOM
    let loginForm = document.getElementById('loginForm');

    //Si el formulario existe agrega un evento submit al formulario
    if (loginForm) {
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            //Evita el envio automatico del formulario
    
            let correo = document.getElementById('correo').value.trim();
            let password = document.getElementById('contraseña').value.trim();
            //Extra los valores ingresados
            //la funcion "trim" elimina los espacios en blanco
    
            if (!correo || !password) {
                alert("Correo y contraseña son obligatorios.");
                return;
            }
            //Verifica con una condicion si los campos estan vacios

            //Crea una instancia de SesionDao   
            let sesionDao = new SesionDao();
            //Llama al método login de la clase SesionDao con los valores ingresados
            let respuesta = await sesionDao.login(correo, password);
            //EL "await" permite esperar la respuesta del serivor
            //Imprime la respuesta del servidor en consola
            console.log("Respuesta del servidor:", respuesta);

            //Si la respuesta es correcta signifiac que la credencial es correcta
            if (respuesta.status) {
                sessionStorage.setItem('usuarioId', respuesta.datos.id_persona); 
                sessionStorage.setItem('clienteId', respuesta.datos.id_cliente); 
                //Guarda el usuarioid e clienteID en el sessionStorage

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


