window.onload = () => {
    mostrarUsuarios(clientes);

}

 class UsuarioDao {

    async obtenerUsuarios() {
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtenerAll";
        let respuesta = await fetch(url);
        let clientes = await respuesta.json();
        return clientes;

    }

    async eliminarUsuario(correo) {
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
        let formData = new FormData();
        formData.append("email",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        if(respuesta.ok){
            alert("Usuario obtenido correctamente");
        } else {
            alert("Error al eliminar el usuario");
        }

    }

    async eliminarUsuario(correo) {
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("email",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        if(respuesta.ok){
            alert("Usuario eliminado correctamente");
        } else {
            alert("Error al eliminar el usuario");
        }

    }

}






export default UsuarioDao;