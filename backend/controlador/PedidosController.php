<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require_once "../modelo/PedidoDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
    case "obtener":
        obtenerPedido();
        break;
    case "obtenerall":
        obtenerPedidos();
        break;
    case "obtenerCliente":
        obtenerPedidosCliente();
        break;
    case "estado":
        cambiarEstadoPedido();
        break;
}
function obtenerPedido()
{ //Funcion para mostrar un pedido
    $id_pedido = $_POST["id_pedido"];
    $resultado = (new PedidoDao())->obtenerPedido($id_pedido);
    echo json_encode($resultado);
}

function obtenerPedidos()
{ //Funcion para mostrar todos los pedidos
    $resultado = (new PedidoDao())->obtenerPedidos();
    echo json_encode($resultado);
}


function obtenerPedidosCliente() {
    $id_cliente = $_GET['id_cliente'] ?? null;  // Usando null si no se encuentra el parámetro
    error_log("ID Cliente recibido en el controlador: " . $id_cliente);  // Log de depuración
    $resultado = (new PedidoDao())->obtenerPedidosCliente($id_cliente);
    echo json_encode($resultado);
}



function cambiarEstadoPedido()
{ // Funcion para modificar el estado de un pedido


    $estado = $_POST["estado"];
    $id_pedido = $_POST["id_pedido"];

    $resultado = (new PedidoDao())->cambiarEstadoPedido($id_pedido, $estado);
    echo json_encode($resultado);
}
