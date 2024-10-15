window.onload =()=> {
      
    mostrarCarrito(productos);
   
}

export default class CarritoController {


    async realizarCompra(nombre, apellido, departamento, ciudad, calle, numero, telefono,id_repuesto) { // con dudas
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/CarritoController.php?funcion=comprar";
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
    async agregarDetalle(id_pedido){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/CarritoController.php?funcion=factura";
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
    async modificarStock(id_repuesto, cantidad){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/CarritoController.php?funcion=stock";
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

    function mostrarCarrito(productos) {
        let tbodyElement = document.querySelector("#divCarrito");
        tbodyElement.innerHTML = "";
        productos.forEach((producto) => { // hay que poner el html que muestra cuando se agrega el producto al carrito
            tbodyElement.innerHTML += ` 
         
               <div class="producto">
                <a><img ${producto.imagen}" height="90px"></a>
                <h4>${producto.nombre}</h4>
                <p>${producto.precio}</p>                                                                     <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO
             ¿¿¿   <p>${detalle.cantidad}</p> ???
                <a><img src="../../BACKEND/IMG/icon_eliminar.png" height="50px"></a>
                <a href="detalle_Producto.html"><img src="../../BACKEND/IMG/info icon.png" height="55px"></a> 
            </div>
    
    
       
     `;
            
        }
    )
    }
