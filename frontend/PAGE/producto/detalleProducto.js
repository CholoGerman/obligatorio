import ProductoDao from "../../DAO/productoDAO.js";
import SesionDao from '../../../frontend/DAO/sesionDAO.js';
import FavoritoDao from "../../DAO/favoritoDAO.js"; // Importar FavoritoDAO

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


    document.getElementById('logoutButton').addEventListener('click', async () => {
        let sesionDao = new SesionDao();
        await sesionDao.logOut(); // Llama a la función de cierre de sesión
    });
};

let menuToggle = document.getElementById('menuToggle');
let dropdownMenu = document.getElementById('dropdownMenu');

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

    <div class="producto">

        <a class="volver" href="#" onclick="window.history.back();"> Volver</a>
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
            <p class="product-details">Stock: ${repuesto.stock}</p>
            
            <div class="product-buttons">
                <button onclick="disminuirCantidad()">-</button>
                <label id="cantidad" style="color:white">1</label>
                <button onclick="aumentarCantidad()">+</button>
                <button id="agregarCarrito">Agregar al Carrito</button>
                <button id="agregarFavorito">Agregar a Favoritos</button>
            </div>

        </div>

    </div>

    <div class="contenedor_descripcion">
        <p class="product-details">Descripción: ${repuesto.descripcion}</p>
    </div>

    `;

    document.getElementById('agregarCarrito').addEventListener('click', () => {
        agregarAlCarrito(repuesto);
    });

    document.getElementById('agregarFavorito').addEventListener('click', () => {
        agregarFavorito(repuesto); // Se llama a la función agregarFavorito
    });
}

function obtenerIdUsuario() {
    return sessionStorage.getItem('usuarioId');
}

// Función para agregar a favoritos
async function agregarFavorito(repuesto) {
    try {
        // Obtener el id_persona desde sessionStorage
        let usuarioId = sessionStorage.getItem('usuarioId');

        // Verificar si el usuarioId está presente en el sessionStorage
        if (!usuarioId) {
            alert("No se ha encontrado un usuario en la sesión.");
            return;
        }

        // Llamar a la función agregarFavorito de FavoritoDao
        let favoritoDao = new FavoritoDao();
        let resultado = await favoritoDao.agregarFavorito(repuesto.id_repuesto, usuarioId);

        // Verificar el resultado y mostrar el mensaje adecuado
        if (resultado.status) {
            console.log("Producto agregado a favoritos:", resultado.message);
            alert("Producto agregado a favoritos!");
        } else {
            console.error("Error al agregar a favoritos:", resultado.message);
            alert(resultado.message);
        }
    } catch (error) {
        console.error("Error al agregar el producto a favoritos:", error);
        alert("Hubo un error al agregar el producto a favoritos.");
    }
}





function agregarAlCarrito(repuesto) {
    // Obtener el carrito actual del sessionStorage o crear uno nuevo
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

    // Verificar si el producto ya está en el carrito
    let productoExistente = carrito.find(item => item.id_repuesto === repuesto.id_repuesto);
    if (productoExistente) {
        // Si ya existe, aumentar la cantidad
        productoExistente.cantidad += cantidad; 
    } else {
        // Si no existe, agregarlo al carrito
        repuesto.cantidad = cantidad; 
        carrito.push(repuesto);
    }

    // Guardar el carrito actualizado en sessionStorage
    sessionStorage.setItem('carrito', JSON.stringify(carrito));

    // // Mostrar una alerta o realizar otra acción

    let notificacion = document.getElementById('notificacion');
    notificacion.classList.remove('ocultar');

    // Ocultar la notificación después de 3 segundos
    setTimeout(() => {
        notificacion.classList.add('ocultar');
    }, 3000);
}
