Window.onload = () => {
    mostrarUsuarios(clientes);

}

export default class UsuarioController {

    async obtenerUsuarios() {
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
        let respuesta = await fetch(url);
        let clientes = await respuesta.json();
        return clientes;

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




function mostrarUsuarios(clientes) {
    let tbodyElement = document.querySelector("#divCatalogo");
    tbodyElement.innerHTML = "";
    clientes.forEach((cliente) => { // Aca va el html que ve el admin para administrar los clientes (debe tener boton eliminar)
        tbodyElement.innerHTML += ` 
     
         
                                                                             <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO

   
 `;
        
    }
)
}