import FavoritoDao from "../../DAO/favoritoDAO";

window.onload = async () => {
    console.log("testfav1")
    let favoritos = await new FavoritoDao().obtenerFavoritos();
    mostrarFavoritos(favoritos);
    console.log("testfav2")
};

function mostrarFavoritos(favoritos) {
    console.log("Catálogo recibido:", favoritos);
    if (favoritos.length === 0) {
        console.log("No se han recibido productos.");
    }
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";

    favoritos.forEach((favorito) => {
        console.log(favorito);
        tbodyElement.innerHTML += ` 
        <div class="contenedor_producto2" data-nombre="${favorito.nombre.toLowerCase()}">                                                      
            <a href="../producto/detalle_Producto.html?id_repuesto=${favorito.id_repuesto}">
                <img src="${favorito.imagen}"> <!-- Asegúrate de que esto esté correcto -->
            </a>
            <div class="detalles">
                <p>${favorito.nombre}</p>
                <p>$${favorito.precio}</p>
            </div>
        </div>
    `;

    });
}
