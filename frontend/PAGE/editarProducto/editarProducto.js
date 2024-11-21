import origen from "../../config/origin.js";
import ProductoDao from '../../../frontend/DAO/productoDAO.js';  

window.onload = async () => {
    // Obtener el parámetro 'id' de la URL
    let urlParams = new URLSearchParams(window.location.search);
    let id_repuesto = urlParams.get('id'); // Obtén el 'id' de la URL
    
    if (!id_repuesto || isNaN(id_repuesto)) {
        console.error(`El ID del producto no es válido: ${id_repuesto}`);
        return;
    }
    
    id_repuesto = parseInt(id_repuesto); // Asegúrate de que sea un número entero
    console.log("ID del producto a buscar:", id_repuesto);

    try {
        // Solicitar el producto al backend
        let producto = await new ProductoDao().obtenerProducto(id_repuesto);
        console.log("Producto recibido:", producto);

        // Verificar si se recibió un producto válido
        if (producto && producto[0]) {
            llenarFormularioConProducto(producto[0]); // Llenar el formulario con los datos
        } else {
            console.error("Producto no encontrado en la respuesta.");
        }
    } catch (error) {
        console.error("Error al cargar el producto:", error);
    }
};


// Función para llenar el formulario con el producto
function llenarFormularioConProducto(producto) {
    // Asigna los valores del producto a los campos del formulario
    document.querySelector("#nombre").value = producto.nombre || '';  
    document.querySelector("#stock").value = producto.stock !== undefined ? producto.stock : '';  
    document.querySelector("#precio").value = producto.precio !== undefined ? producto.precio : '';  
    document.querySelector("#descripcion").value = producto.descripcion || '';  
    document.querySelector("#estado").value = producto.estado || '';  
    document.querySelector("#color").value = producto.color || '';  

    // Si hay una imagen, asignar el src a la vista previa de la imagen
    if (producto.imagen) {
        document.querySelector("#imagenPreview").src = producto.imagen;
    }

    // Configura el envío del formulario para modificar el producto
    document.querySelector("#editarProductoForm").onsubmit = async (e) => {
        e.preventDefault(); // Evita que la página se recargue

        // Recoger los datos del formulario
        let formData = new FormData(document.querySelector("#editarProductoForm"));
        formData.append("id_repuesto", producto.id_repuesto);  // Agregar el ID del producto al formulario

        // Enviar la solicitud para actualizar el producto
        let respuesta = await new ProductoDao().modificarProducto(formData);
        if (respuesta.status) {
            alert('Producto actualizado correctamente');
            // Redirige o recarga la página según sea necesario
            window.location.href = origen + '/frontend/PAGE/gestionProductos/gestion_Productos.html'; 
        } else {
            alert('Error al actualizar el producto');
        }
    };
}

