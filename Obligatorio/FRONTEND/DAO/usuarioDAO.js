export default class UsuarioController {

    async obtenerUsuarios() {
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/UsuarioController.php?funcion=obtener";
        let respuesta = await fetch(url);

    }


    async eliminarUsuario(correo) {
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/UsuarioController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("email",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);

    }

}