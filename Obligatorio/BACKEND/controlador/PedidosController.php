<?php
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "obtener":
        obtenerPedido();
        break;
    case "obtenerall":
        obtenerPedidos();
        break;
    case "estado":
        cambiarEstadoPedido();
        break;
}
function obtenerPedido(){
    $resultado = (new PedidoDao())->obtenerPedido($id_repuesto);
    echo json_encode($resultado);

}

function obtenerPedidos(){
    $resultado = (new PedidoDao())->obtenerPedidos();
    echo json_encode($resultado);

}

function cambiarEstadoPedido(){

    
}
