import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async function() {
    let productoDao = new ProductoDao();
    await productoDao.obtenerEstadisticas(mostrarEstadisticas);  
}

function mostrarEstadisticas(estadisticas) {
    console.log("Estadísticas de productos recibidas:", estadisticas);

    let contenedorEstadisticas = document.querySelector("#contenedor_estadisticas");
    contenedorEstadisticas.innerHTML = '';  // Limpiar contenido previo

    estadisticas.forEach(producto => {
        // Asegurarse de que las ganancias_totales son números antes de usar toFixed
        let gananciasTotales = parseFloat(producto.ganancias_totales) || 0;  // Si no es número, establecer como 0

        let imagenUrl = `../../../backend/IMG/${producto.id_repuesto}.${producto.imagen_extension}`;
        contenedorEstadisticas.innerHTML += `
            <div class="producto">
                <a><img src="${imagenUrl}" height="140px"></a>
                <h2>${producto.nombre}</h2>
                <div class="datos">
                    <p>Ventas: ${producto.ventas_totales}</p>
             <p>Ganancias: $${producto.ganancias_totales}</p>

                </div>
            </div>
        `;
    });
}






