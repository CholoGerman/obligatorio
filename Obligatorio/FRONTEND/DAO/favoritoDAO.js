export default class FavoritoController{


    async agregarFavorito(id_producto){

        //consultar si necesita informacion

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    

    }
    
    
    async eliminarFavorito(id_producto){

         //consultar si necesita informacion

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    
    
    }
    
    
    async obtenerFavoritos(){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/FavoritoController.php?funcion=obtener";
        let respuesta = await fetch(url);
    
        
    }

}