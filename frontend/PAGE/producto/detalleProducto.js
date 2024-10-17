window.onload = async () => {

    let producto = await new ProductoDao().obtenerProducto();
    mostrarProducto(producto);

    

}



const menuToggle = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');

menuToggle.addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace recargue la página
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Cierra el menú si se hace clic fuera de él
document.addEventListener('click', function(event) {
    if (!menuToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
    }
});



function mostrarProducto(producto) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = ""; // Limpiar el contenido previo

    tbodyElement.innerHTML += ` 
        <div class="contenedor_img">
            <img src="${producto.imagen}" style="aspect-ratio: auto" alt="${producto.nombre}">
        </div>
        <div class="product-info">
            <div class="primera_fila">
                <h1 class="product-title">${producto.nombre}</h1>
                <p class="product-price">${producto.precio}.99</p>
            </div>
            <p class="product-details">Estado: ${producto.estado}</p>
            <p class="product-details">Año: ${producto.año}</p>
            <p class="product-details">Color: ${producto.color}</p>
            <p class="product-details">Descripción: ${producto.descripcion}</p>
            <div class="product-buttons">
                <button>Agregar al carrito</button>
            </div>
        </div>  
    `;
}

