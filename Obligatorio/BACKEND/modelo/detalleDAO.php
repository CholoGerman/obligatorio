<?php
require_once '../conexion/conexion.php';

class detalle
{

    function obtener(){
        $connection = connection();
        $sql = "SELECT * FROM detalle ";
        $respuesta = $connection->query($sql);
        $detalles = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $detalles;
    }
    public function agregar($cantidad,  $precio_unitario, $total, $id_repuesto, $id_pedido, $fecha){
        $sql = "INSERT INTO detalle VALUES(0, $cantidad, $precio_unitario, $total, $id_repuesto, $id_pedido, $fecha);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_detalle){
        $sql = "DELETE FROM detalle WHERE id_detalle= $id_detalle;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_detalle, $cantidad, $precio_unitario, $total, $id_repuesto, $id_pedido){
        $sql = "UPDATE detalle SET cantidad=$cantidad, precio_unitario=$precio_unitario, total=$total, id_repuesto=$id_repuesto, id_pedido=$id_pedido id_detalle= $id_detalle;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}