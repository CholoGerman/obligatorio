window.onload =()=> {
    mostrarFavorito(productos);
}


class FavoritoDao{


    async  agregarFavorito(id_producto, id_cliente){

       

        let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("id_producto",id_producto);
        formData.append("id_cliente",id_cliente);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let favorito = await respuesta.json();
        return favorito;

    
    

    }
    
    
    async  eliminarFavorito(id_producto){

        

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
    
    
    async  obtenerFavoritos(correo){
    
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




export default FavoritoDao;