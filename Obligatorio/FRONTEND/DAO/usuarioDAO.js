export default class UsuarioController {

    async obtenerUsuarios() {


    }


    async eliminarUsuario(correo) {
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/UsuarioController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("email",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);

    }

}