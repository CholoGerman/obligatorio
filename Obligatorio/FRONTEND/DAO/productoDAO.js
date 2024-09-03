export default class ProductoController{

     async obtenerProductos(){



    }
    
    
    async obtenerCatalogo(){
    
    
    }
    
    
    async agregarProducto(){

        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/ProductoController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("email",tipo);
        formData.append("password",precio);
        formData.append("password",color);
        formData.append("password",precio);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        
    
    }
    
    async eliminarProducto(){
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/ProductoController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_producto",id);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    }


}