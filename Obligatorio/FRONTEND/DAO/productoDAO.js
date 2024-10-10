window.onload =()=> {
      
    mostrarCatalogo(productos);
    mostrarProducto(productos);
}
export default class ProductoController{

   


     async obtenerProducto(id_repuesto){

         let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
         let formData = new FormData();
         formData.append("id_repuesto",id_repuesto);
         let config = {
             method:"POST",
             body:formData
         }
         let respuesta = await fetch(url,config);
         let producto = await respuesta.json();
         return producto;


    }
    
    
    async obtenerCatalogo(){
    
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";
        let respuesta = await fetch(url);
        let productos = await respuesta.json();
        return productos;
 
}
    
    
    async agregarProducto(tipo,precio,color,estado){

        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
        let formData = new FormData();
        formData.append("tipo",tipo);
        formData.append("precio",precio);
        formData.append("color",color);
        formData.append("estado",estado);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let producto = await respuesta.json();
        return producto;
        
    
    }
    
    async eliminarProducto(){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let producto = await respuesta.json();
        return producto;
    
    }


}


function mostrarCatalogo(productos) {
    let tbodyElement = document.querySelector("#divCatalogo");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // aca va el html para mostrar todos los productos en el catalogo
        tbodyElement.innerHTML += ` 
     
           <div class="contenedor_producto">

                <div class="contenedor_producto2">                                                       <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO

                    <a href="../PAGE/detalle_Producto.html"><img ${producto.imagen} "></a> 
                   
                        <div class="detalles">
                        <p>${producto.nombre}</p>
                        <p>$${producto.precio}.90</p>
                        </div>
                        
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