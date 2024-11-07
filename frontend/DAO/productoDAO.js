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
    async agregarProducto() {
        let formElement = document.querySelector("#agregarProductoForm");
        formElement.onsubmit = async (e) => {
            e.preventDefault();  // Evitar el comportamiento por defecto (recarga de la página)
    
            let formFormData = new FormData(formElement);
            let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
    
            let config = {
                method: "POST",
                body: formFormData
            };
    
            try {
                let respuesta = await fetch(url, config);
                let repuestos = await respuesta.json();
                console.log(repuestos);
                alert("Producto agregado correctamente");
                formElement.reset();
            } catch (error) {
                console.error("Error en el envío del producto:", error);
            }
        };
    }
    
    // Eliminar un producto
    async eliminarProducto(id_repuesto) {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
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
