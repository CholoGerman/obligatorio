import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async () => {
    const params = new URLSearchParams(window.location.search);
    const productId = params.get('id_repuesto'); 

    if (productId) {
        try {
            let repuestos = await new ProductoDao().obtenerProducto(productId); // Pasa el id
            if (repuestos.length > 0) {
                mostrarProducto(repuestos[0]); // Accede al primer elemento
            } else {
                console.error("No se encontró el repuesto con el ID especificado.");
            }
        } catch (error) {
            console.error("Error al obtener el producto:", error);
        }
    } else {
        console.error("No se ha encontrado el ID del producto en la URL.");
    }
};

const menuToggle = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');

menuToggle.addEventListener('click', function(event) {
    event.preventDefault();
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Cierra el menú si se hace clic fuera de él
document.addEventListener('click', function(event) {
    if (!menuToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
    }
});



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

function mostrarProducto(repuesto) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = ""; 

    tbodyElement.innerHTML += ` 
        <div class="contenedor_img">
            <img src="${repuesto.imagen}" style="aspect-ratio: auto" alt="${repuesto.nombre}">
        </div>
        <div class="product-info">
            <div class="primera_fila">
                <h1 class="product-title">${repuesto.nombre}</h1>
                <p class="product-price">$${repuesto.precio}</p>
            </div>
            <p class="product-details">Estado: ${repuesto.estado}</p>
            <p class="product-details">Color: ${repuesto.color}</p>
            <p class="product-details">Descripción: ${repuesto.descripcion}</p>
            <div class="product-buttons">
                    <button onclick="location.href='../PAGE/realizar_Compra.html'">Comprar</button> 
                    <button onclick="disminuirCantidad()">-</button><label id="cantidad" style="color:white">0</label> <button onclick="aumentarCantidad()">+</button>
                    <button>Agregar al carrito</button>
                </div>
        </div>  
    `;
}
