class SesionDao {

  async fetchRequest(url, method, body) {
    let config = {
        method: method,
        body: body
    };
    
    let respuesta = await fetch(url, config);
    
    if (!respuesta.ok) {
        const errorText = await respuesta.text(); // Obtener el texto completo de la respuesta
        console.error(`HTTP error! status: ${respuesta.status}, response: ${errorText}`);
        throw new Error(`HTTP error! status: ${respuesta.status}`);
    }
    
    return await respuesta.json();
}


    async registerAdmin(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=registerAdmin"; 
        let formData = new FormData();
        formData.append("correo", correo);
        formData.append("contraseña", password);
        formData.append("nombre", nombre);
        formData.append("apellido", apellido);
    
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson);
    
        if (respuestaJson.status) {
            alert("Admin registrado correctamente"); // Mensaje de éxito
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado"));
        }
    }
    


    async register(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=register"; 
        let formData = new FormData();
        formData.append("correo", correo);
        formData.append("contraseña", password);
        formData.append("nombre", nombre);
        formData.append("apellido", apellido);
    
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson); // Agrega este log
    
        // Asegúrate de verificar si 'status' y 'mensaje' están presentes
        if (respuestaJson.status) {
            alert(respuestaJson.mensaje); // Usa 'mensaje' para mostrar
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado"));
        }
    }
    
   

    

    async login(correo, password) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
        let formData = new FormData();
        formData.append("correo", correo);
        formData.append("contraseña", password);
        
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson);
    
        if (respuestaJson.status) {
            console.log("isAdmin:", respuestaJson.datos.isAdmin); // Agrega este log
            // Verifica si es admin y redirige
            if (respuestaJson.datos && respuestaJson.datos.isAdmin) {
                window.location.href = 'http://localhost/obligatorio/frontend/PAGE/admin/controlador_Admin.html'; // Redirigir al panel de admin
            } else {
                window.location.href = 'http://localhost/obligatorio/frontend/PAGE/inicio/index.html'; // Redirigir al home
            }
        } else {
            alert(respuestaJson.mensaje);
        }
    }
    
    
    
    
    
    
    

    async logOut() {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut";
        let respuesta = await fetch(url);
        let respuestaJson;
    
        try {
            respuestaJson = await respuesta.json();
            console.log("Respuesta del servidor:", respuestaJson);
            
            if (respuestaJson.status) {
                // Redirigir al login sin mostrar alerta
                window.location.href = "../../PAGE/login/login.html"; // Ajusta la ruta según sea necesario
            } else {
                console.error(respuestaJson.mensaje);
            }
        } catch (error) {
            console.error("Error al parsear JSON:", error);
        }
    }
    
    

    
    
    
    
    
}

export default SesionDao;
