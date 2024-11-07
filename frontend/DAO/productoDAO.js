window.onload = async () => { 
    let agregar = new ProductoDao();
    agregar.agregarProducto(); 
}


class ProductoDao {

    // Obtener un producto por su ID
    async obtenerProducto(id_repuesto) {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
        let formData = new FormData();
        formData.append("id_repuesto", id_repuesto);

        let config = {
            method: "POST",
            body: formData
        }

        let respuesta = await fetch(url, config);
        let producto = await respuesta.json();
        return producto;
    }

    // Obtener el catálogo de productos
    async obtenerCatalogo() {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";

        let respuesta = await fetch(url);
        let productos = await respuesta.json();

        // Filtrar productos con stock mayor a 0
        return productos.filter(producto => producto.stock > 0);
    }

    // Agregar un nuevo producto
    async agregarProducto(formData) {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar"; 

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
        let url = `http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar`;
        let formData = new FormData();
        formData.append("id_repuesto", id_repuesto);

        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let producto = await respuesta.json();
        return producto;
    }


    // Modificar un producto existente
    async modificarProducto(formData) {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=modificar";
        let config = {
            method: "POST",
            body: formData
        };

        let respuesta = await fetch(url, config);
        let productoModificado = await respuesta.json();
        return productoModificado;
    }
}


export default ProductoDao;
