<?php
require_once '../conexion/conexion.php';

class detalle
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los detalle del pedido
        $connection = connection();
        $sql = "SELECT * FROM detalle ";
        $respuesta = $connection->query($sql);
        $detalles = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $detalles;
    }
    public function agregar($cantidad,  $precio_unitario, $total, $id_repuesto, $id_pedido, $fecha){ //Funcion que indica los parametros y consulta sql a utilizar para agregar un detalle del pedido
        $sql = "INSERT INTO detalle VALUES(0, $cantidad, $precio_unitario, $total, $id_repuesto, $id_pedido, $fecha);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_detalle){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar un detalle del pedido
        $sql = "DELETE FROM detalle WHERE id_detalle= $id_detalle;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_detalle, $cantidad, $precio_unitario, $total, $id_repuesto, $id_pedido){  //Funcion que indica los parametros y consulta sql a utilizar para editar un detalle del pedido
        $sql = "UPDATE detalle SET cantidad=$cantidad, precio_unitario=$precio_unitario, total=$total, id_repuesto=$id_repuesto, id_pedido=$id_pedido id_detalle= $id_detalle;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}