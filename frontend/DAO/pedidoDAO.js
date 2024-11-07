window.onload =()=> {
      
    mostrarPedido(pedido);
    mostrarPedidos(pedido);
}


 class PedidoDao{

    async  obtenerPedido(id_pedido){
    let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
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
async  obtenerPedidos(){
    let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";
    let respuesta = await fetch(url);
    let pedidos = await respuesta.json();
    return pedidos;


}
async  cambiarEstadoPedido(id_detalle,estado){

    let url ="http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=estado";
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




export default PedidoDao;
