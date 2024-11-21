import FavoritoDao from "../../DAO/favoritoDAO.js";

window.onload = async () => {
    // Obtener el ID del cliente desde sessionStorage
    let clienteId = sessionStorage.getItem('clienteId');

    console.log("Cliente ID obtenido:", clienteId);

    if (clienteId) {
        try {
            let favoritos = await new FavoritoDao().obtenerFavoritos(clienteId);
            mostrarFavoritos(favoritos);
        } catch (error) {
            console.error("Error al obtener los favoritos:", error);
        }
    } else {
        console.error("No se encontró el ID del cliente en sessionStorage.");
        alert("Error: No se encontró el ID del cliente en la sesión.");
    }
};

function mostrarFavoritos(favoritos) {
    console.log("Favoritos recibidos:", favoritos);

    if (!favoritos || favoritos.length === 0) {
        console.log("No se han recibido favoritos.");
        return;
    }

    let contenedor = document.querySelector("#contenedor_favoritos");
    contenedor.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos favoritos

    favoritos.forEach((favorito) => {
        let precio = parseFloat(favorito.precio);  // Convertir a número

        contenedor.innerHTML += `
            <div class="producto" data-id="${favorito.id_favorito}">
                <p>Nombre: ${favorito.nombre}</p>
                <p>Color: ${favorito.color}</p>
                <p>Stock: ${favorito.stock}</p>
                <p>Precio: ${isNaN(precio) ? 'N/A' : precio.toFixed(2)} €</p>
                <p>Descripción: ${favorito.descripcion || 'No disponible'}</p>
                <button class="eliminar-favorito" data-id="${favorito.id_favorito}">Eliminar de favoritos</button>
            </div>
        `;
    });

    // Agregar los eventos de eliminación
    document.querySelectorAll('.eliminar-favorito').forEach((btnEliminar) => {
        btnEliminar.addEventListener('click', async (event) => {
            let id_favorito = event.target.dataset.id;
            console.log('Eliminar favorito con ID:', id_favorito);

            // Confirmación antes de eliminar
            if (confirm('¿Estás seguro de que deseas eliminar este producto de tus favoritos?')) {
                try {
                    let respuesta = await new FavoritoDao().eliminarFavorito(clienteId, id_favorito);
                    if (respuesta.status) {
                        alert('Producto eliminado de favoritos');
                        // Eliminar el elemento del DOM
                        event.target.closest('.producto').remove();
                    } else {
                        alert('Hubo un problema al eliminar el favorito');
                    }
                } catch (error) {
                    console.error('Error al eliminar el favorito:', error);
                    alert('Hubo un problema al eliminar el favorito');
                }
            }
        });
    });
}
