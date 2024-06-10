<?php
require_once '../conexion/conexion.php';

class detalle
{

    function obtener(){
        $connection = connection();
        $sql = "SELECT * FROM detalle ";
        $respuesta = $connection->query($sql);
        $pacientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pacientes;
    }
    public function agregar($cantidad,  $precio_unitario, $total, $ID_repuesto, $ID_pedido, $fecha){
        $sql = "INSERT INTO detalle VALUES(0, $cantidad, $precio_unitario, $total, $ID_repuesto, $ID_pedido, $fecha);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID_detalle){
        $sql = "DELETE FROM detalle WHERE ID_detalle= $ID_detalle;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_detalle, $cantidad, $precio_unitario, $total, $ID_repuesto, $ID_pedido){
        $sql = "UPDATE detalle SET cantidad=$cantidad, precio_unitario=$precio_unitario, total=$total, ID_repuesto=$ID_repuesto, ID_pedido=$ID_pedido ID_detalle= $ID_detalle;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}