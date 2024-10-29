let datosCarrito =[];

window.onload = () => {
    mostrarCarrito();



};



// Función para mostrar los productos en el carrito
function mostrarCarrito() {
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];
    datosCarrito = carrito;
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


                 <div class="product-buttons">

                <button onclick="disminuirCantidad(${producto.id_repuesto})">-</button>
                <label id="cantidad" style="color:white">${producto.cantidad}</label>
                <button onclick="aumentarCantidad(${producto.id_repuesto})">+</button>


            </div>
        

                <p>Subtotal: $${producto.precio * producto.cantidad}</p>
            </div>
        `;
        total += producto.precio * producto.cantidad;
    });

    document.getElementById('total').innerText = `Total: $${total}`;
}

//  let cantidad = 

function aumentarCantidad(id) {

    console.log(id); 
    let carrito = datosCarrito.map(producto => {
        if (producto.id_repuesto == id) {
            producto.cantidad++;
            // console.log(producto);
        }
        return producto;
    });
   
    guardarCarrito(carrito);
    mostrarCarrito();

    // cantidad += 1; 
    // document.getElementById('cantidad').innerHTML = cantidad; 
}

function guardarCarrito(carrito){
    console.log(carrito);
window.sessionStorage.setItem("carrito",JSON.stringify(carrito));


}

function disminuirCantidad(id) {

    console.log(id); 
    let carrito = datosCarrito.map(producto => {
        if (producto.id_repuesto == id && producto.cantidad > 1) {
            producto.cantidad--;
            // console.log(producto);
        }
        return producto;
    });
   id
   
    guardarCarrito(carrito);
    mostrarCarrito();
}

window.aumentarCantidad = aumentarCantidad;
window.disminuirCantidad = disminuirCantidad;











