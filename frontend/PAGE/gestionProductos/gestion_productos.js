import ProductoDao from '../../../frontend/DAO/productoDAO.js'; 

window.onload = async () => {
    let catalogo = await new ProductoDao().obtenerCatalogo();
    mostrarCatalogo(catalogo);
};

function mostrarCatalogo(catalogo) {
    console.log("Catálogo recibido:", catalogo);  
    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
        return; // Retorna si no hay productos
    }
    
    let tbodyElement = document.querySelector("#contenedor_productos");
    tbodyElement.innerHTML = "";  

    catalogo.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
            <div class="producto" data-id="${repuesto.id_repuesto}"> <!-- Asegúrate de que esto esté correcto -->
                <a><img src="${repuesto.imagen || '../../BACKEND/IMG/img ejemplo.jpg'}" alt="${repuesto.nombre}" height="90px"></a>
                <p>${repuesto.nombre}</p>
                <p>Stock: ${repuesto.stock}</p>
                <a class="eliminar" data-id="${repuesto.id_repuesto}"><img src="../../../backend/IMG/icon_eliminar.png" alt="Eliminar" height="45px"></a>
                <!-- Modificar producto -->
                <a class="modificar" data-id="${repuesto.id_repuesto}"><img src="../../../backend/IMG/modificar icon.png" alt="Modificar" height="43px"></a>
                <a><img src="../../../backend/IMG/info icon.png" alt="Información" height="55px"></a>
            </div>
        `;
    }); 

    // Asignar el evento de eliminación después de que se haya leído el catálogo
    document.querySelectorAll('.eliminar').forEach((botonEliminar) => {
        botonEliminar.addEventListener('click', async (event) => {
            let id_repuesto = event.target.closest('.eliminar').dataset.id;
            await eliminarProducto(id_repuesto);
        });
    });

    // Asignar el evento de modificación
    document.querySelectorAll('.modificar').forEach((botonModificar) => {
        botonModificar.addEventListener('click', (event) => {
            let id_repuesto = event.target.closest('.modificar').dataset.id;
            // Redirigir a la página de modificar, pasando el ID como parámetro en la URL
            window.location.href = `modificar.html?id_repuesto=${id_repuesto}`;
        });
    });
}





async function eliminarProducto(id_repuesto) {
    try {
        let respuesta = await fetch('http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_repuesto })
        });

        let resultado = await respuesta.json();
        console.log("Respuesta del servidor:", resultado); // Log para ver la respuesta completa

        if (resultado.status) { // Cambia 'exito' a 'status'
            console.log("Producto eliminado correctamente");
            // Recargar el catálogo después de eliminar
            let catalogo = await new ProductoDao().obtenerCatalogo();
            mostrarCatalogo(catalogo);
        } else {
            console.error("Error al eliminar el producto:", resultado.mensaje);
        }
    } catch (error) {
        console.error("Error en la solicitud de eliminación:", error);
    }
}
