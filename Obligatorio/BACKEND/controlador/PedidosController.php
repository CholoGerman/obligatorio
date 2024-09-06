<?php
require_once "../modelo/PedidoDAO.php";

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
    $id_pedido = $_POST["id_pedido"];
    $resultado = (new PedidoDao())->obtenerPedido($id_pedido);
    echo json_encode($resultado);

}

function obtenerPedidos(){
    $resultado = (new PedidoDao())->obtenerPedidos();
    echo json_encode($resultado);

}

function cambiarEstadoPedido(){
    $estado = $_POST["estado"];
    $id_pedido = $_POST["id_pedido"];
    $resultado = (new PedidoDao())->obtenerPedido($id_pedido, $estado);
    echo json_encode($resultado);
}
