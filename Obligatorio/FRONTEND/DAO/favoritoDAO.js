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

/* function mostrarFavorito(productos) { incompleto

    let tbodyElement = document.querySelector("#divFavorito");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // por modificar 
        tbodyElement.innerHTML += ` 
     
           <div class="producto">
            <a><img ${producto.imagen}" height="90px"></a>
            <h4>${producto.nombre}</h4>
            <p>${producto.precio}</p>
         ¿¿¿   <p>${detalle.cantidad}</p> ???
            <a><img src="../../BACKEND/IMG/icon_eliminar.png" height="50px"></a>
            <a href="detalle_Producto.html"><img src="../../BACKEND/IMG/info icon.png" height="55px"></a> 
        </div>


   
 `;
        
    }
)
}
*/