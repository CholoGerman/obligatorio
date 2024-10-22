import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async () => {


    let params = new URLSearchParams(window.location.search);
    let productId = params.get('id_repuesto'); 

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

let menuToggle = document.getElementById('menuToggle');
let dropdownMenu = document.getElementById('dropdownMenu');

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


let cantidad = 1; 
function aumentarCantidad() {
    cantidad += 1; 
    document.getElementById('cantidad').innerHTML = cantidad; 
}

function disminuirCantidad() {
    if (cantidad > 1) { // Cambiado a 1 para que la cantidad mínima sea 1
        cantidad -= 1; 
        document.getElementById('cantidad').innerHTML = cantidad; 
    }
}
window.aumentarCantidad = aumentarCantidad;
window.disminuirCantidad = disminuirCantidad;


function mostrarProducto(repuesto) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = ""; 

    let imagenSrc = `../../../backend/IMG/${repuesto.id_repuesto}.${repuesto.extension}`; // letruir la ruta de la imagen

    tbodyElement.innerHTML += ` 
        <a href="#" onclick="window.history.back();" style="color:white; text-decoration: none; font-size: 12px;"> Volver</a>
        <div class="contenedor_img">
            <img src="${imagenSrc}" style="aspect-ratio: auto" alt="${repuesto.nombre}">
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
                    <button onclick="disminuirCantidad()">-</button><label id="cantidad" style="color:white">1</label> <button onclick="aumentarCantidad()">+</button>
                    <button>Agregar al carrito</button>
                </div>
        </div>  
    `;
}

