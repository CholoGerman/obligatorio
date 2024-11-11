let datosCarrito = [];

window.onload = () => {
    mostrarCarrito();
    document.getElementById('realizarCompra').addEventListener('click', realizarCompra);
    document.getElementById('divCarrito').addEventListener('click', eliminarProducto);

};

window.irAFomularioCompra = function() {
    window.location.href = '../comprar/realizar_compra.html'; 
}

// Función para mostrar los productos en el carrito
function mostrarCarrito() {
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];
    datosCarrito = carrito;
    let divCarrito = document.getElementById('divCarrito');

    divCarrito.innerHTML = "";

    if (carrito.length === 0) {
        divCarrito.innerHTML = "<p class='aviso_carritoVacio'>El carrito está vacío.</p>";
        document.getElementById('total').innerText = "Total: $0";
        return;
    }

    let total = 0;

    carrito.forEach(producto => {
        divCarrito.innerHTML += `
            <div class="producto" data-id="${producto.id_repuesto}" >
                <h4>${producto.nombre}</h4>
                <p>Precio: $${producto.precio}</p>
                <div class="product-buttons">
                    <button class="btn_stock" onclick="disminuirCantidad(${producto.id_repuesto})">-</button>
                    <label id="cantidad" style="color:white">${producto.cantidad}</label>
                    <button class="btn_stock" onclick="aumentarCantidad(${producto.id_repuesto})">+</button>
                </div>
                <p>Subtotal: $${producto.precio * producto.cantidad}</p>

                <div class="icon">
                    <a class="eliminar"><img src="../../../backend/IMG/icon_eliminar.png" alt="Eliminar" height="45px"></a>
                </div>

            </div>
        `;
        total += producto.precio * producto.cantidad;
    });

    document.getElementById('total').innerText = `Total: $${total}`;
}

function eliminarProducto(event) {
    // Verificar si el clic fue sobre un enlace con la clase "eliminar"
    if (event.target.closest('a.eliminar')) {
    
        let productoId = event.target.closest('.producto').getAttribute('data-id');

        // Eliminar el producto del carrito
        datosCarrito = datosCarrito.filter(producto => producto.id_repuesto != productoId);

        // Guardar los cambios en sessionStorage
        guardarCarrito(datosCarrito);

        // Mostrar el carrito actualizado
        mostrarCarrito();
    }
}







function aumentarCantidad(id) {
    let carrito = datosCarrito.map(producto => {
        if (producto.id_repuesto == id) {
            producto.cantidad++;
        }
        return producto;
    });
   
    guardarCarrito(carrito);
    mostrarCarrito();
}

function guardarCarrito(carrito) {
    window.sessionStorage.setItem("carrito", JSON.stringify(carrito));
}

function disminuirCantidad(id) {
    let carrito = datosCarrito.map(producto => {
        if (producto.id_repuesto == id && producto.cantidad > 1) {
            producto.cantidad--;
        }
        return producto;
    });
   
    guardarCarrito(carrito);
    mostrarCarrito();
}

window.aumentarCantidad = aumentarCantidad;
window.disminuirCantidad = disminuirCantidad;

async function realizarCompra() {
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];
    if (carrito.length === 0) {
        alert("El carrito está vacío. Agrega productos para continuar.");
        return;
    }

    // Crear un array para almacenar los IDs de los repuestos y las cantidades
    let datosCompra = carrito.map(producto => ({
        id_repuesto: producto.id_repuesto,
        cantidad: producto.cantidad,
        precio: producto.precio
    }));

    // Almacenar los datos de la compra en sessionStorage
    sessionStorage.setItem('datosCompra', JSON.stringify(datosCompra));

    // Redirige al formulario de compra
    window.location.href = '../comprar/realizar_compra.html';
}










