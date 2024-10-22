class SesionDao {

    // Método para realizar una solicitud fetch
    async fetchRequest(url, method, body) {
      // Configura la solicitud
      let config = {
          method: method,
          body: body // El cuerpo de la solicitud (puede ser FormData)
      };
      
      // Realiza la solicitud fetch
      let respuesta = await fetch(url, config);
      
      // Verifica si la respuesta fue exitosa
      if (!respuesta.ok) {
          const errorText = await respuesta.text(); // Obtener el texto completo de la respuesta
          console.error(`HTTP error! status: ${respuesta.status}, response: ${errorText}`); // Log del error
          throw new Error(`HTTP error! status: ${respuesta.status}`); // Lanzar error si la solicitud falla
      }
      
      // Retorna la respuesta en formato JSON
      return await respuesta.json();
  }
  
    // Método para registrar un nuevo administrador
    async registerAdmin(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=registerAdmin"; 
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        formData.append("nombre", nombre); // Agregar nombre
        formData.append("apellido", apellido); // Agregar apellido
    
        // Realiza la solicitud para registrar al administrador
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson); // Log de la respuesta del servidor
    
        // Verifica si la respuesta indica éxito
        if (respuestaJson.status) {
            alert("Admin registrado correctamente"); // Mensaje de éxito
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado")); // Mensaje de error
        }
    }
  
    // Método para registrar un nuevo usuario
    async register(correo, password, nombre, apellido) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=register"; 
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        formData.append("nombre", nombre); // Agregar nombre
        formData.append("apellido", apellido); // Agregar apellido
    
        // Realiza la solicitud para registrar al usuario
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson); // Log de la respuesta del servidor
    
        // Verifica si la respuesta indica éxito
        if (respuestaJson.status) {
            alert(respuestaJson.mensaje); // Usa 'mensaje' para mostrar
        } else {
            alert("Error: " + (respuestaJson.mensaje || "Ocurrió un problema inesperado")); // Mensaje de error
        }
    }
  
    // Método para iniciar sesión
    async login(correo, password) {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
        let formData = new FormData(); // Crear un nuevo objeto FormData
        formData.append("correo", correo); // Agregar correo
        formData.append("contraseña", password); // Agregar contraseña
        
        // Realiza la solicitud para iniciar sesión
        let respuestaJson = await this.fetchRequest(url, "POST", formData);
        console.log("Respuesta del servidor:", respuestaJson); // Log de la respuesta del servidor
    
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
  
    // Método para cerrar sesión
    async logOut() {
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut"; // URL para cerrar sesión
        let respuesta = await fetch(url); // Realiza la solicitud para cerrar sesión
        let respuestaJson;
    
        try {
            respuestaJson = await respuesta.json(); // Intenta parsear la respuesta a JSON
            console.log("Respuesta del servidor:", respuestaJson); // Log de la respuesta del servidor
            
            // Verifica si la respuesta indica éxito
            if (respuestaJson.status) {
                // Redirigir al login sin mostrar alerta
                window.location.href = "../../PAGE/login/login.html"; // Ajusta la ruta según sea necesario
            } else {
                console.error(respuestaJson.mensaje); // Log del mensaje de error
            }
        } catch (error) {
            console.error("Error al parsear JSON:", error); // Log del error al parsear
        }
    }
  }
  
  // Exporta la clase SesionDao para su uso en otros módulos
  export default SesionDao;
  
