window.onload = async () => {

    let producto = await new ProductoDao().obtenerProducto();
    mostrarProducto(producto);

    

}



const menuToggle = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');
let cantidad=0;
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


function obtenerProductoPorId(id) {
    // Aquí puedes hacer una solicitud AJAX para obtener los detalles del producto
    // Por ejemplo, usando fetch:
    fetch(`../../backend/modelo/ProductoDAO${id}`)
        .then(response => response.json())
        .then(producto => mostrarProducto([producto]))
        .catch(error => console.error("Error al obtener el producto:", error));
}

function aumentarCantidad() {
   
    cantidad += 1;  // Incrementa la cantidad
    document.getElementById('cantidad').innerHTML = cantidad;  // Actualiza el contenido
}

function disminuirCantidad() {
    if (cantidad > 0) {  // Asegúrate de que la cantidad no sea menor a 1
        cantidad -= 1;  // Decrementa la cantidad
        document.getElementById('cantidad').innerHTML = cantidad;  // Actualiza el contenido
    }
}




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






document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const productId = params.get('id');
    if (productId) {
        obtenerProductoPorId(productId);
    }
});