export default class ProductoController{

     async obtenerProductos(){

         let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
        let respuesta = await fetch(url);
    
    


    }
    
    
    async obtenerCatalogo(){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";
        let respuesta = await fetch(url);
    
    }
    
    
    async agregarProducto(){

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("tipo",tipo);
        formData.append("precio",precio);
        formData.append("color",color);
        formData.append("precio",precio);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        
    
    }
    
    async eliminarProducto(){
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/ProductoController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    }


}