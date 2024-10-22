class SesionDao {

    // Funcion para realizar una solicitud fetch
    async fetchRequest(url, method, body) {
      // Configura la solicitud
      let config = {
          method: method,
          body: body 
      };
      
      // Realiza la solicitud fetch
      let respuesta = await fetch(url, config);
      return await respuesta.json();
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
    async login(correo, password) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        
        // Realiza la solicitud para iniciar sesión
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
 
        // Verifica si la respuesta indica éxito
        if (respuestaJson.status) {
            console.log("isAdmin:", respuestaJson.datos.isAdmin); // Log del estado de administrador
            // Verifica si es admin y redirige según corresponda
            if (respuestaJson.datos && respuestaJson.datos.isAdmin) {
                window.location.href = 'http://localhost/obligatorio/frontend/PAGE/admin/controlador_Admin.html'; // Redirigir al panel de admin
            } else {
                window.location.href = 'http://localhost/obligatorio/frontend/PAGE/inicio/index.html'; // Redirigir al home
            }
        } else {
            alert(respuestaJson.mensaje); // Mensaje de error
        }
    }
  
    // Funcion para cerrar sesión
    async logOut() {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut"; // URL para cerrar sesión
        let respuesta = await fetch(url); // Realiza la solicitud para cerrar sesión
        let respuestaJson;
    
        try {
            respuestaJson = await respuesta.json(); // Intenta parsear la respuesta a JSON
            console.log("Respuesta del servidor:", respuestaJson); // Log de la respuesta del servidor
            
            // Verifica si la respuesta indica éxito
            if (respuestaJson.status) {
                // Redirigir al login
                window.location.href = "../../PAGE/login/login.html";
            } else {
                console.error(respuestaJson.mensaje); // Log del mensaje de error
            }
        } catch (error) {
            console.error("Error al parsear JSON:", error); // Log del error al parsear
        }
    }
  }
  

  export default SesionDao;
  
