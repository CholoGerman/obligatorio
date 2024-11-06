import ProductoDao from '../../../frontend/DAO/productoDAO.js'; 

// Se asegura de que el código se ejecute después de que el DOM haya cargado completamente
window.onload = async () => {
    let catalogo = await new ProductoDao().obtenerCatalogo();
    mostrarCatalogo(catalogo);
};

// Función que recibe el catálogo de productos y lo muestra en el HTML
function mostrarCatalogo(catalogo) {
    console.log("Catálogo recibido:", catalogo);

    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
        return; // No hacer nada si no hay productos
    }

    let tbodyElement = document.querySelector("#contenedor_productos");
    tbodyElement.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevos productos

    // Iterar sobre el catálogo para agregar cada producto a la tabla o contenedor
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
            console.log('ID del producto a modificar:', id_repuesto);  // Ver en la consola si el ID es correcto

            // Verificar si el ID existe y redirigir al formulario de edición
            if (id_repuesto) {
                window.location.href = `http://localhost/obligatorio/frontend/PAGE/editarProducto/editarProducto.html?id=${id_repuesto}`;
            } else {
                console.error('ID no encontrado en el atributo data-id');
            }
        });
    });

    // Asignar el evento de eliminación después de que se haya cargado el catálogo
    document.querySelectorAll('.eliminar').forEach((botonEliminar) => {
        botonEliminar.addEventListener('click', async (event) => {
            let id_repuesto = event.target.closest('.eliminar').dataset.id;
            await eliminarProducto(id_repuesto);
        });
    });
}