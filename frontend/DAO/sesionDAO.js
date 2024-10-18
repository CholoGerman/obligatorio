window.onload = () => {
    const registroForm = document.getElementById('registroForm');

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

    document.getElementById('loginForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        let correo = document.getElementById('correo').value;
        let password = document.getElementById('contraseña').value;
    
        let sesionDao = new SesionDao();
        await sesionDao.login(correo, password);
    });
    
    // Aquí puedes mantener el evento de registro si es necesario
    document.getElementById('registroForm').addEventListener('submit', async (event) => {
        // Código de registro...
    });
};

class SesionDao {
    async register(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=register"; 
        let formData = new FormData();
        formData.append("correo", correo);
        formData.append("contraseña", password);
        formData.append("nombre", nombre);
        formData.append("apellido", apellido);

        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let respuestaJson = await respuesta.json();
        
        if (respuestaJson.success) {
            alert("Registro exitoso");
        } else {
            alert(respuestaJson.message);
        }
    }





    
async login(correo, password) {
    let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
    let formData = new FormData();
    formData.append("correo", correo);
    formData.append("contraseña", password); // Asegúrate de que sea "contraseña" y no "password"
    
    let config = {
        method: "POST",
        body: formData
    };

    let respuesta = await fetch(url, config);
    let respuestaJson = await respuesta.json();
    if (respuestaJson.success) {
        alert("Bienvenido " + respuestaJson.usuario.nombre); // Asegúrate de acceder correctamente al nombre
    } else {
        alert(respuestaJson.message);
    }
}

    
    
    
     async logOut(){
        let url ="http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut";
        let respuesta = await fetch(url);
        let respuestaJson = await respuesta.json();
        if(respuestaJson.success){
            alert("Sesión cerrada correctamente");
        } else{
            alert(respuestaJson.message);
        }
    
        
    }
}



export default SesionDao;