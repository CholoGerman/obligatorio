window.onload =()=> {
      
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
    let pedido = await respuesta.json();
    return pedido;


}
async obtenerPedidos(){
    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=obtenerall";
    let respuesta = await fetch(url);
    let pedidos = await respuesta.json();
    return pedidos;


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
    if(respuesta.ok){
        let mensaje = await respuesta.text();
        alert(mensaje);
    }else{
        let mensaje = await respuesta.text();
        alert("Error: "+mensaje);
    }

}
    
}

  function mostrarPedido(pedido) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // aca va el html que se ve cuando abrimos un pedido en especifico (lo puede ver tanto el admin como el cliente)
        tbodyElement.innerHTML += ` 
     
                                                 <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO

   
 `;
        
    }
)
}
function mostrarPedidos(productos) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => { // aca ve el html que ve el admin cuando ve todos los pedidos
        tbodyElement.innerHTML += ` 
     
          
                                                 <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO

   
 `;
        
    }
)
}
