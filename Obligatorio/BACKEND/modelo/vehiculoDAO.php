<?php
require_once '../conexion/conexion.php';

class vehiculo
{

    function obtener()
{
        $connection = connection();
        $sql = "SELECT * FROM vehiculo ";
        $respuesta = $connection->query($sql);
        $vehiculos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $vehiculos;
    }
    public function agregar($marca, $modelo, $anio){ 
        $sql = "INSERT INTO vehiculo VALUES(0, '$marca', '$modelo', '$anio');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_vehiculo){
        $sql = "DELETE FROM vehiculo WHERE id_vehiculo= $id_vehiculo;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_vehiculo, $marca, $modelo, $anio){
        $sql = "UPDATE vehiculo SET marca='$marca', modelo='$modelo', anio='$anio' WHERE id_vehiculo= $id_vehiculo;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>
