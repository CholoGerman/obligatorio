export default class PedidoController{

async obtenerPedido(){
    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=obtener";
    let respuesta = await fetch(url);


}
async obtenerPedidos(){
    let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/PedidosController.php?funcion=obtenerall";
    let respuesta = await fetch(url);


}
async cambiarEstadoPedido(){

    
}

}