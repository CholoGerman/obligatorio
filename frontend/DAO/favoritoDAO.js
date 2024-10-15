window.onload =()=> {
    mostrarFavorito(productos);
}


export default class FavoritoController{


    async agregarFavorito(id_producto, correo){

       

        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
        formData.append("correo",correo);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let favorito = await respuesta.json();
        return favorito;

    
    

    }
    
    
    async eliminarFavorito(id_producto){

        

        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let favorito = await respuesta.json();
        return favorito;
    
    
    
    }
    
    
    async obtenerFavoritos(correo){
    
        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
        let formData = new FormData();
        formData.append("correo",correo);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let favoritos = await respuesta.json();
        return favoritos;
    
        
    }

}

// va a favorito.js


 function mostrarFavorito(productos) { incompleto

    let tbodyElement = document.querySelector("#divFavorito");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // hay que poner el html de lo que muestra el cartel desplegable de los favoritos
        tbodyElement.innerHTML += ` 
     
                                                                                  <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO

   
 `;
        
    }
)
}
