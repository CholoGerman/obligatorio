<?php
require_once '../conexion/conexion.php';

class repuesto
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los repuestos
        $connection = connection();
        $sql = "SELECT * FROM repuesto ";
        $respuesta = $connection->query($sql);
        $repuestos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $repuestos;
    }
    public function agregar($tipo,  $precio, $color, $estado, $id_vehiculo){  //Funcion que indica los parametros y consulta sql a utilizar para agregar un repuesto
        $sql = "INSERT INTO repuesto VALUES(0, '$tipo', $precio, '$color', '$estado', $id_vehiculo);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_repuesto){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar un repuesto
        $sql = "DELETE FROM repuesto WHERE id_repuesto= $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_repuesto, $tipo, $precio, $color, $estado, $id_vehiculo){  //Funcion que indica los parametros y consulta sql a utilizar para editar un repuesto
        $sql = "UPDATE repuesto SET tipo='$tipo', precio='$precio', color='$color', estado='$estado', $id_vehiculo=id_vehiculo WHERE id_repuesto= $id_repuesto;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>