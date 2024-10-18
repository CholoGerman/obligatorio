window.onload =()=> {
    let carrito = new carritoDao();
    carrito.agregarProducto(); 
    mostrarCarrito(productos);
   
}

 class CarritoDao {


    async  realizarCompra(nombre, apellido, departamento, ciudad, calle, numero, telefono,id_repuesto) { // con dudas
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=comprar";
        formData.append("nombre",nombre);
        formData.append("apellido",apellido);
        formData.append("departamento",departamento);
        formData.append("ciudad",ciudad);
        formData.append("calle",calle);
        formData.append("numero",numero);
        formData.append("telefono",telefono);
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        if(respuesta.ok){
            alert("Compra realizada con exito");
        }else{
            alert("Hubo un error al realizar la compra");
        }

    
    
    
    }
    async  agregarDetalle(id_pedido){
    
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=factura";
        let formData = new FormData();
        formData.append("id_pedido",id_pedido);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        if(respuesta.ok){
            alert("Detalle añadido con exito");
        } else{
            alert("Hubo un error al agregar el detalle");
        }
    
        
    }
    async  modificarStock(id_repuesto, cantidad){
    
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=stock";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
        formData.append("cantidad",cantidad);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        if(respuesta.ok){
            alert("Stock modificado con exito");
        } else{
            alert("Hubo un error al modificar el stock");
        }
    
        
    }
    }

    export default CarritoDao;