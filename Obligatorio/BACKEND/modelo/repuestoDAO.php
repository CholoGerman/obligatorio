<?php
require_once '../conexion/conexion.php';

class repuesto
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM repuesto ";
        $respuesta = $connection->query($sql);
        $repuestos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $repuestos;
    }
    public function agregar($tipo,  $precio, $color, $estado, $id_vehiculo){ 
        $sql = "INSERT INTO repuesto VALUES(0, '$tipo', $precio, '$color', '$estado', $id_vehiculo);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_repuesto){
        $sql = "DELETE FROM repuesto WHERE id_repuesto= $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_repuesto, $tipo, $precio, $color, $estado, $id_vehiculo){
        $sql = "UPDATE repuesto SET tipo=$tipo, precio=$precio, color=$color, estado=$estado, $id_vehiculo=id_vehiculo WHERE id_repuesto= $id_repuesto;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>