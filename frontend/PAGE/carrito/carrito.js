window.onload = () => {
    mostrarCarrito();
};



// Función para mostrar los productos en el carrito
function mostrarCarrito() {
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];
    let divCarrito = document.getElementById('divCarrito');
    divCarrito.innerHTML = "";

    if (carrito.length === 0) {
        divCarrito.innerHTML = "<p>El carrito está vacío.</p>";
        document.getElementById('total').innerText = "Total: $0";
        return;
    }

    let total = 0;

    carrito.forEach(producto => {
        divCarrito.innerHTML += `
            <div class="producto">
                <h4>${producto.nombre}</h4>
                <p>Precio: $${producto.precio}</p>
                <p>Cantidad: ${producto.cantidad}</p>
                <p>Subtotal: $${producto.precio * producto.cantidad}</p>
            </div>
        `;
        total += producto.precio * producto.cantidad;
    });

    document.getElementById('total').innerText = `Total: $${total}`;
}















