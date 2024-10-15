class ProductoDAO{

   


     async obtenerProducto(id_repuesto){

         let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
         let formData = new FormData();
         formData.append("id_repuesto",id_repuesto);
         let config = {
             method:"POST",
             body:formData
         }
         let respuesta = await fetch(url,config);
         let producto = await respuesta.json();
         return producto;


    }
    
    
    async obtenerCatalogo(){
        let url ="http://localhost/obligatorio/obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";

        let respuesta = await fetch(url);
        let productos = await respuesta.json();
        console.log(productos);
        return productos;
 
}
    
    
    async agregarProducto(tipo,precio,color,estado){

        let url ="http://localhost/obligatorio/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("tipo",tipo);
        formData.append("precio",precio);
        formData.append("color",color);
        formData.append("estado",estado);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let repuestos = await respuesta.json();
        return repuestos;
        
        
    
    }
    
    async eliminarProducto(){
        let url ="http://localhost/obligatorio/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let producto = await respuesta.json();
        return producto;
        
    
    }


}



export default ProductoDAO;