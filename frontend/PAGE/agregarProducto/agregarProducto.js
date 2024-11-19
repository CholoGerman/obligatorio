
import ProductoDao from "../../DAO/productoDAO.js"; 

window.onload = () => {
    let formElement = document.getElementById('agregarProductoForm');

    // Escuchar el evento de envío del formulario
    formElement.addEventListener('submit', async (event) => {
        event.preventDefault();  // Evitar el comportamiento por defecto del formulario (recarga de página)

        // Obtener los datos del formulario
        let formData = new FormData(formElement); // Captura todos los datos del formulario, incluyendo la imagen

        // Instanciar ProductoDao para enviar los datos
        let productoDao = new ProductoDao();

        try {
            // Llamar al método agregarProducto de ProductoDao
            let respuesta = await productoDao.agregarProducto(formData);

            // Mostrar mensaje de éxito o error
            if (respuesta.status) {
                alert("Producto agregado correctamente");
                formElement.reset();  // Limpiar el formulario
            } else {
                alert("Error al agregar el producto: " + respuesta.mensaje);
            }
        } catch (error) {
            console.error("Error en el envío del producto:", error);
            alert("Hubo un problema al agregar el producto. Intenta de nuevo.");
        }
    });
};




