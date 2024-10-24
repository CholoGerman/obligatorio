import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async () => {
    let params = new URLSearchParams(window.location.search);
    let productId = params.get('id_repuesto'); 

    if (productId) {
        try {
            let repuestos = await new ProductoDao().obtenerProducto(productId);
            if (repuestos.length > 0) {
                mostrarProducto(repuestos[0]); 
            } else {
                console.error("No se encontró el repuesto con el ID especificado.");
            }
        } catch (error) {
            console.error("Error al obtener el producto:", error);
        }
    } else {
        console.error("No se ha encontrado el ID del producto en la URL.");
    }
    
    obtenerIdUsuario();
};

let cantidad = 1; 

function aumentarCantidad() {
    cantidad += 1; 
    document.getElementById('cantidad').innerHTML = cantidad; 
}

function disminuirCantidad() {
    if (cantidad > 1) {
        cantidad -= 1; 
        document.getElementById('cantidad').innerHTML = cantidad; 
    }
}
window.aumentarCantidad = aumentarCantidad;
window.disminuirCantidad = disminuirCantidad;

function mostrarProducto(repuesto) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = ""; 

    let imagenSrc = `../../../backend/IMG/${repuesto.id_repuesto}.${repuesto.extension}`;

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
                <button onclick="disminuirCantidad()">-</button>
                <label id="cantidad" style="color:white">1</label>
                <button onclick="aumentarCantidad()">+</button>
                <button id="agregarCarrito">Agregar al Carrito</button>
            </div>
        </div>
    `;

    document.getElementById('agregarCarrito').addEventListener('click', () => {
        agregarAlCarrito(repuesto);
    });
}

function obtenerIdUsuario() {
    return sessionStorage.getItem('usuarioId');
}

function agregarAlCarrito(repuesto) {
    // Obtener el carrito actual del sessionStorage o crear uno nuevo
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

    // Verificar si el producto ya está en el carrito
    let productoExistente = carrito.find(item => item.id_repuesto === repuesto.id_repuesto);
    if (productoExistente) {
        // Si ya existe, aumentar la cantidad
        productoExistente.cantidad += cantidad; // Usa la cantidad seleccionada
    } else {
        // Si no existe, agregarlo al carrito
        repuesto.cantidad = cantidad; // Inicializar la cantidad
        carrito.push(repuesto);
    }

    // Guardar el carrito actualizado en sessionStorage
    sessionStorage.setItem('carrito', JSON.stringify(carrito));

    // Mostrar una alerta o realizar otra acción
    alert("Producto agregado al carrito.");
}













