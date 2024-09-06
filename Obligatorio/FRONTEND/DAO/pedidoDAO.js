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

