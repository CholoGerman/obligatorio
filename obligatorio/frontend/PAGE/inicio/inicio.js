import ProductoDAO from "../../DAO/productoDAO.js";

window.onload = async () => {
let catalogo = await new ProductoDAO().obtenerCatalogo()
console.log(catalogo);

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






function mostrarCatalogo(repuestos) {
    console.log("aaaa",repuestos);
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";
    repuestos.forEach((repuesto) => { 
        tbodyElement.innerHTML += ` 
     


                <div class="contenedor_producto2">                                                      

                    <a href="../PAGE/detalle_Producto.html"><img ${repuesto.imagen} "></a> 
                   
                        <div class="detalles">
                        <p>${repuesto.nombre}</p>
                        <p>$${repuesto.precio}</p>
                       
                 </div>
                        



   
 `;
        
    }
)
}

function mostrarProducto(productos) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // aca va el html de cuando vemos un producto en especifico
        tbodyElement.innerHTML += ` 
     
            <div class="contenedor_img">
                <a><img ${producto.imagen}" style="aspect-ratio: auto"></a>
            </div>

            <div class="product-info">

                <div class="primera_fila">
                    <h1 class="product-title">${producto.nombre}</h1>                            <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO
                    <p class="product-price">${producto.precio}.99</p>
                </div>
                <p class="product-details">Estado: ${producto.estado}</p>
                <p class="product-details">Año: ${producto.año}</p>
                <p class="product-details">Color: ${producto.color}</p>
                <div class="product-buttons">
                    <!-- <button onclick="location.href='../PAGE/realizar_Compra.html'">Comprar</button> -->
                    <button>Agregar al carrito</button>
                </div>

            </div>  
        </div>


   
 `;
        
    }
)
}
