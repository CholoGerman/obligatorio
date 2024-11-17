
//SE crea la clase sesionDAO
class SesionDao {

    // Funcion para realizar una solicitud fetch
    async fetchRequest(url, method, body) {

        try {
            let response = await fetch(url, {
                method: method,
                body: body,
            });
    
            //Si la la solicitud esta ok convierte en JSON
            //Si esta mal se maneja con el bloque "catch"
            //Que devulve un objeto jSON que incluye mensaje
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

        //Usa la url del controlador para hacer peticiones de datos
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=registerAdmin"; 

        // Crea un nuevo objeto FormData para enviar los datos del formulario al controlador
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
  
    async login(correo, password) {

        // Usa la url del controlador para hacer peticiones de datos
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=login";
        
        // Crea un nuevo objeto FormData para enviar los datos del formulario al controlador
        let formData = new FormData();
        formData.append("correo", correo);
        formData.append("contraseña", password);
        
        // Realiza la solicitud para iniciar sesión
        try {
            let respuestaJson = await this.fetchRequest(url, "POST", formData);
            console.log("Respuesta del servidor:", respuestaJson); // Verifica la respuesta
            

            if (respuestaJson.status) {
                sessionStorage.setItem('usuarioId', respuestaJson.datos.id_persona); // Almacena el ID
                // ... resto del código ...
            }
            
    
            // Devuelve la respuesta
            return respuestaJson;
        } catch (error) {
            console.error('Error al procesar la solicitud:', error);
            return { status: false, mensaje: "Error de conexión." }; // Manejo de error
        }
    }
    
    // Funcion para cerrar sesión
    async logOut() {
        
        // Usa la url del controlador para hacer peticiones de datos
        let url = "http://localhost/obligatorio/backend/controlador/SesionController.php?funcion=logOut"; 
        
        // Realiza la solicitud para cerrar sesión
        let respuesta = await fetch(url); 
        // Parsea la respuesta JSON
        let respuestaJson;
    
        // Maneja la respuesta JSON en caso de éxito
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
  // Exportar la clase para usar en otros archivos
    export default SesionDao;

  
