export default class FavoritoController{


    async agregarFavorito(id_producto, correo){

       

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
        formData.append("correo",correo);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    

    }
    
    
    async eliminarFavorito(id_producto){

        

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    
    
    }
    
    
    async obtenerFavoritos(correo){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=obtener";
        let formData = new FormData();
        formData.append("correo",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
        
    }

}