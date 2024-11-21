import origen from "../config/origin.js";

window.onload = async () => { 
    let agregar = new ProductoDao();
    agregar.agregarProducto(); 
}



class ProductoDao {

    // Metodo para obtener producto usando su id por parametroasync obtenerProducto(id_repuesto) {
        async obtenerProducto(id_repuesto) {
            if (!id_repuesto || isNaN(id_repuesto)) {
                console.error("ID de producto inválido:", id_repuesto);
                return { error: "ID de producto inválido" };
            }
        
            let url = origen + "/backend/controlador/ProductosController.php?funcion=obtener";
            let formData = new FormData();
            formData.append("id_repuesto", id_repuesto);
        
            let config = {
                method: "POST",
                body: formData,
            };
        
            try {
                let respuesta = await fetch(url, config);
        
                if (!respuesta.ok) {
                    throw new Error(`HTTP error! status: ${respuesta.status}`);
                }
        
                let producto = await respuesta.json();
                return producto;
            } catch (error) {
                console.error("Error al obtener el producto:", error);
                return { error: "Error en la solicitud" };
            }
        }

    
    

    // Obtener el catálogo de productos
    async obtenerCatalogo() {
        let url =  origen + "/backend/controlador/ProductosController.php?funcion=obtenerall";
        let config = {
            method: "GET",
        };
    
        try {
            let respuesta = await fetch(url, config);
            let productos = await respuesta.json();
            console.log("Productos obtenidos:", productos); 
            
        return productos.filter(producto => producto.stock > 0); //retorna solo productos con stock mayor a 0;
        } catch (error) { //Muestra un error
            console.error("Error al obtener productos:", error);
            return []; //Retorna un arreglo vacio
        }
    
    }

    // Agregar un nuevo producto
    async agregarProducto(formData) {
        let url = origen + "/backend/controlador/ProductosController.php?funcion=agregar"; 

        // Configuración de la solicitud (POST)
        let config = {
            method: "POST",
            body: formData  // Enviar los datos del formulario (incluyendo la imagen)
        };

        try {
            let respuesta = await fetch(url, config);
            let data = await respuesta.json();

            if (respuesta.ok) {
                return data;  // Retornar la respuesta del backend
            } else {
                throw new Error("No se pudo agregar el producto.");
            }
        } catch (error) {
            console.error("Error al agregar el producto:", error);
            return { status: false, mensaje: "Error al agregar el producto" };
        }
    }
    
    
    // Eliminar un producto
    async eliminarProducto(id_repuesto) {
        let url = origen + "/backend/controlador/ProductosController.php?funcion=eliminar";
        
        // Crear FormData y agregar el id_repuesto
        let formData = new FormData();
        formData.append("id_repuesto", id_repuesto);  // Asegúrate de que id_repuesto es un número válido

        let config = {
            method: "POST",
            body: formData
        };

        try {
            let respuesta = await fetch(url, config);

            // Verificar si la respuesta fue exitosa
            if (!respuesta.ok) {
                throw new Error("Error al eliminar el producto, estado HTTP: " + respuesta.status);
            }

            // Intentamos parsear la respuesta como JSON
            let producto = await respuesta.json();
            
            // Retornar la respuesta del backend
            return producto;

        } catch (error) {
            console.error("Error al eliminar el producto:", error);
            throw new Error("Error al eliminar el producto");
        }
    }


    // Modificar un producto existente
    async modificarProducto(formData) {
        let url = origen + "/backend/controlador/ProductosController.php?funcion=modificar";
        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let productoModificado = await respuesta.json();
        return productoModificado;
    }



    async obtenerEstadisticas(callback) {
        try {
            let url = origen + "/backend/controlador/ProductosController.php?funcion=obtenerEstadisticas";
            let respuesta = await fetch(url);
            let estadisticas = await respuesta.json();
    
            if (estadisticas.error) {
                console.error("Error al obtener estadísticas:", estadisticas.error);
                return;
            }
    
          
            if (callback) {
                callback(estadisticas);  // Llama a la función que pasó el usuario (mostrarEstadisticas)
            }
    
        } catch (error) {
            console.error("Error al realizar la solicitud:", error);
        }
    }
    

}


export default ProductoDao;
