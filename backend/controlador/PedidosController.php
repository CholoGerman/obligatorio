<?php
require_once "../modelo/PedidoDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
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
function obtenerPedido(){ //Funcion para mostrar un pedido
    $id_pedido = $_POST["id_pedido"];
    $resultado = (new PedidoDao())->obtenerPedido($id_pedido);
    echo json_encode($resultado);

}

function obtenerPedidos(){ //Funcion para mostrar todos los pedidos
    $resultado = (new PedidoDao())->obtenerPedidos();
    echo json_encode($resultado);

}

function cambiarEstadoPedido(){ //Funcion para modificar el estado de un pedido
    $estado = $_POST["estado"];
    $id_pedido = $_POST["id_pedido"];
    $resultado = (new PedidoDao())->obtenerPedido($id_pedido, $estado);
    echo json_encode($resultado);
}
