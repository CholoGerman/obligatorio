import origen from "../../config/origin.js"
import ProductoDao from '../../DAO/productoDAO.js'; 

// Se asegura de que el código se ejecute después de que el DOM haya cargado completamente
window.onload = async () => {
    // Obtener todos los productos (sin filtrar por stock)
    let catalogo = await new ProductoDao().obtenerCatalogo(false);  // 'false' para no filtrar productos por stock
    mostrarCatalogo(catalogo);


     // Añadir el evento para filtrar productos por nombre
     document.getElementById('buscar_producto').addEventListener('input', (event) => {
        filtrarProductos(event, catalogo);
    });
};

// Función que recibe el catálogo de productos y lo muestra en el HTML
function mostrarCatalogo(catalogo) {
    console.log("Catálogo recibido:", catalogo);

    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
        return; 
    }

    let tbodyElement = document.querySelector("#contenedor_productos");
    tbodyElement.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevos productos


    catalogo.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
            <div class="producto" data-id="${repuesto.id_repuesto}">
               <p>${repuesto.nombre}</p>
               <p>Stock: ${repuesto.stock}</p>
               <a class="eliminar" data-id="${repuesto.id_repuesto}">
                   <img src="../../../backend/IMG/icon_eliminar.png" alt="Eliminar" height="45px">
               </a>
               <a class="modificar" data-id="${repuesto.id_repuesto}"> 
                   <img src="../../../backend/IMG/modificar icon.png" alt="Modificar" height="43px">
               </a>
               <a>
                   <img src="../../../backend/IMG/info icon.png" alt="Información" height="55px">
               </a>
            </div>
        `;
    });
    // Asignar evento de clic a los enlaces de "modificar"
    document.querySelectorAll('.modificar').forEach((botonModificar) => {
        botonModificar.addEventListener('click', (event) => {
            // Obtener el ID del producto para redirigir
            let id_repuesto = event.target.closest('.modificar').dataset.id;
            console.log('ID del producto:', id_repuesto);  // Ver en la consola si el ID es correcto

            // Verificar si el ID existe y redirigir al formulario de edición
            if (id_repuesto) {
                window.location.href = origen + '/frontend/PAGE/editarProducto/editarProducto.html?id=${id_repuesto}';
            } else {
                console.error('ID no encontrado en el atributo data-id');
            }
        });
    });

    document.querySelectorAll('.eliminar').forEach((botonEliminar) => {
        botonEliminar.addEventListener('click', async (event) => {
            let id_repuesto = event.target.closest('.eliminar').dataset.id;
            console.log("ID del producto:", id_repuesto);

            // Confirmación antes de eliminar
            if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                return; // Si el usuario cancela, no hace nada
            }

            let productoDao = new ProductoDao();

            try {
                let respuesta = await productoDao.eliminarProducto(id_repuesto);

                if (respuesta.status) {
                    alert('Producto eliminado correctamente');
                    event.target.closest('.producto').remove();
                } else {
                    alert('Hubo un problema al eliminar el producto');
                }
            } catch (error) {
                console.error('Error al eliminar el producto:', error);
                alert('Hubo un problema al eliminar el producto');
            }
        });
    });
}



// Función para filtrar productos según el texto ingresado en el campo de búsqueda
function filtrarProductos(event, catalogo) {
    const query = event.target.value.toLowerCase(); // Obtener el texto de búsqueda
    const productosFiltrados = catalogo.filter(producto => 
        producto.nombre.toLowerCase().includes(query)
    );
    mostrarCatalogo(productosFiltrados); // Mostrar los productos filtrados
}