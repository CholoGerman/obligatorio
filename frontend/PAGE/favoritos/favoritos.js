import FavoritoDao from "../../DAO/favoritoDAO.js";

window.onload = async () => {
    // Obtener el ID del cliente desde sessionStorage
    let clienteId = sessionStorage.getItem('clienteId');

    console.log("Cliente ID obtenido:", clienteId);

    if (clienteId) {
        try {
            let favoritos = await new FavoritoDao().obtenerfavoritos(clienteId);
            mostrarfavoritos(favoritos);
        } catch (error) {
            console.error("Error al obtener los favoritos:", error);
        }
    } else {
        console.error("No se encontró el ID del cliente en sessionStorage.");
        alert("Error: No se encontró el ID del cliente en la sesión.");
    }
};

function mostrarfavoritos(favoritos) {
    console.log("favoritos recibidos:", favoritos);
    if (!favoritos || favoritos.length === 0) {
        console.log("No se han recibido favoritos.");
        return;
    }

    let tbodyElement = document.querySelector("#contenedor_favoritos");
    tbodyElement.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos favoritos

    favoritos.forEach((favorito) => {

        let precio = parseFloat(favorito.precio);  // Convertir a número
        tbodyElement.innerHTML += `
            <div class="producto" data-id="${favorito.id_favorito}">
                <p>ID favorito: ${favorito.id_favorito}</p>
                <p>Fecha: ${favorito.fecha}</p>
                <p>Método: ${favorito.metodo}</p>
                <p>Cantidad: ${favorito.cantidad}</p>
                <p>Precio: ${isNaN(precio) ? 'N/A' : precio.toFixed(2)} €</p>
                <p>Número de Dirección: ${favorito.num_dir}</p>
                <p>Calle: ${favorito.calle_dir}</p>
                <p>Estado: ${favorito.estado}</p>
            </div>  
        `;
    });
}
