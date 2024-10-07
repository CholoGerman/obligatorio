window.onload =function() {
      
    mostrarPedido(pedido);
    mostrarPedidos(pedido);
}


export default class PedidoController{

async obtenerPedido(id_pedido){
    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=obtener";
    let formData = new FormData();
    formData.append("id_pedido",id_pedido);
    let config = {
        method:"POST",
        body:formData
    }
    let respuesta = await fetch(url,config);


}
async obtenerPedidos(){
    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=obtenerall";
    let respuesta = await fetch(url);


}
async cambiarEstadoPedido(id_detalle,estado){

    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=estado";
    let formData = new FormData();
    formData.append("estado",estado);
    formData.append("id_detalle",id_detalle);
    let config = {
        method:"POST",
        body:formData
    }
    let respuesta = await fetch(url,config);

}
    
}

 /* function mostrarPedido(pedido) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // por modificar
        tbodyElement.innerHTML += ` 
     
            <div class="contenedor_img">
                <a><img ${producto.imagen}" style="aspect-ratio: auto"></a>
            </div>

            <div class="product-info">

                <div class="primera_fila">
                    <h1 class="product-title">${producto.nombre}</h1>
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
function mostrarPedidos(productos) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // por modificar
        tbodyElement.innerHTML += ` 
     
            <div class="contenedor_img">
                <a><img ${producto.imagen}" style="aspect-ratio: auto"></a>
            </div>

            <div class="product-info">

                <div class="primera_fila">
                    <h1 class="product-title">${producto.nombre}</h1>
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
*/ 