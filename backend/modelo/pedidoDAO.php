<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
class PedidoDao{
function obtenerPedido($id_pedido){ //Funcion para mostrar un pedido
    $connection = connection();
    $sql = "SELECT * FROM Pedido WHERE id_pedido=$id_pedido";
    $respuesta = $connection->query($sql);
    $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $pedidos;

}

function obtenerPedidos(){ //Funcion para mostrar todos los pedidos
    $connection = connection();
    $sql = "SELECT * FROM Pedido;";
    $respuesta = $connection->query($sql);
    $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $pedidos;

}

function cambiarEstadoPedido($id_pedido, $estado){ //Funcion para modificar el estado de un pedido
    $connection = connection();
    $sql = "UPDATE detalle SET estado = '$estado' WHERE id_pedido=$id_pedido;";       
    $respuesta = $connection->query($sql);
    $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $pedidos;
    return new Respuesta(true, "Estado actualizado", null);
}


}