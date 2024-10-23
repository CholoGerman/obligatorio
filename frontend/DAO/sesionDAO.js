class SesionDao {

    // Funcion para realizar una solicitud fetch
    async fetchRequest(url, method, body) {
        try {
            let response = await fetch(url, {
                method: method,
                body: body,
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            return await response.json();
        } catch (error) {
            console.error("Error en la solicitud:", error);
            return { status: false, mensaje: "Error en la solicitud: " + error.message };
        }
    }
    
    
  
    // Funcion para registrar un nuevo administrador
    async registerAdmin(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=registerAdmin"; 
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        formData.append("nombre", nombre); // Agregar nombre
        formData.append("apellido", apellido); // Agregar apellido
    
        // Realiza la solicitud para registrar al administrador
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
       
    
        // Verifica si la respuesta indica éxito
        if (respuestaJson.status) {
            alert("Admin registrado correctamente"); // Si el admin se registra correctamente
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado")); // Mensaje de error
        }
    }
  
    // Funcion para registrar un nuevo usuario
    async register(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=register"; 
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        formData.append("nombre", nombre); // Agregar nombre
        formData.append("apellido", apellido); // Agregar apellido
    
        // Realiza la solicitud para registrar al usuario
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
    
        // Verifica si la respuesta indica éxito
        if (respuestaJson.status) {
            alert(respuestaJson.mensaje); // Usa 'mensaje' para mostrar
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado")); // Mensaje de error
        }
    }
  
    // Funcion para iniciar sesión
   // Función para iniciar sesión
   async login(correo, password) {
    let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
    let formData = new FormData();
    formData.append("correo", correo);
    formData.append("contraseña", password);
    
    try {
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson); // Verifica la respuesta
        
        // Devuelve la respuesta
        return respuestaJson;
    } catch (error) {
        console.error('Error al procesar la solicitud:', error);
        return { status: false, mensaje: "Error de conexión." }; // Manejo de error
    }
}



    
    
    
    
    
    
    // Funcion para cerrar sesión
    async logOut() {
        // Lógica para cerrar sesión en el servidor (si aplica)
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut"; 
        let respuesta = await fetch(url); 
        let respuestaJson;
    
        try {
            respuestaJson = await respuesta.json(); 
            
            if (respuestaJson.status) {
                // Limpiar el sessionStorage
                sessionStorage.removeItem('carrito');
                sessionStorage.removeItem('usuarioId');
                // Redirigir al login
                window.location.href = "../../PAGE/login/login.html";
            } else {
                console.error(respuestaJson.mensaje);
            }
        } catch (error) {
            console.error("Error al parsear JSON:", error);
        }
    }
    
  }

    export default SesionDao;

  
