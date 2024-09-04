<?php
require_once "../conexion/conexion.php";

class PedidoDao{
function obtenerPedido($id_repuesto){
    $connection = connection();
    $sql = "SELECT * FROM Repuesto WHERE id_repuesto=$id_repuesto";
    $respuesta = $connection->query($sql);
    $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $usuarios;

}

function obtenerPedidos(){
    $connection = connection();
    $sql = "SELECT * FROM Repuesto";
    $respuesta = $connection->query($sql);
    $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $usuarios;

}

function cambiarEstadoPedido(){

    
}


}