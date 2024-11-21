import origen from "../config/origin.js";

class FavoritoDao {
    // Método para agregar un producto a favoritos
    async agregarFavorito(repuesto, usuarioId) {
        try {
            let response = await fetch(`${origen}/backend/controlador/FavoritoController.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'id_repuesto': repuesto.id_repuesto,
                    'id_persona': usuarioId
                })
            });
    
            // Verificamos si la respuesta es válida
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
    
            // Intentamos obtener el resultado JSON
            let resultado;
            try {
                resultado = await response.json();
            } catch (e) {
                throw new Error('La respuesta no es un JSON válido');
            }
    
            if (resultado.status) {
                console.log("Producto agregado a favoritos:", resultado.message);
                alert("Producto agregado a favoritos!");
            } else {
                console.error("Error al agregar a favoritos:", resultado.message);
                alert(resultado.message);
            }
        } catch (error) {
            console.error("Error al agregar el producto a favoritos:", error);
            alert("Hubo un error al agregar el producto a favoritos.");
        }
    }
    

    // Método para eliminar un producto de favoritos
    async eliminarFavorito(id_cliente, id_repuesto) {
        let url = origen + "/backend/controlador/FavoritoController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_cliente", id_cliente);  // id_cliente del usuario
        formData.append("id_repuesto", id_repuesto);  // id_repuesto del producto

        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let favorito = await respuesta.json();
        return favorito;
    }

    // Método para obtener todos los favoritos de un cliente
    async obtenerFavoritos(id_cliente) {
        let url = origen + "/backend/controlador/FavoritoController.php?funcion=obtener";
        let formData = new FormData();
        formData.append("id_cliente", id_cliente);  // id_cliente del usuario

        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let favoritos = await respuesta.json();
        return favoritos;
    }
}

export default FavoritoDao;
