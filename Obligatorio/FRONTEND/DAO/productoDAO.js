export default class ProductoController{

     async obtenerProducto(id_repuesto){

         let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
         let formData = new FormData();
         formData.append("id_repuesto",id_repuesto);
         let config = {
             method:"POST",
             body:formData
         }
         let respuesta = await fetch(url,config);


    }
    
    
    async obtenerCatalogo(){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";
        let respuesta = await fetch(url);
        let tbodyElement = document.querySelector("#contenedor_producto");
    productos.forEach((producto) => {
        let trELement = document.createElement("tr");
        trELement.innerHTML = `


      html 
   
 `;
    }
}
    
    
    async agregarProducto(tipo,precio,color,estado){

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
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
        
    
    }
    
    async eliminarProducto(){
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    }


}