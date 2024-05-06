<?php
require_once '../conexion/conexion.php';

class repuesto
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM repuesto ";
        $respuesta = $connection->query($sql);
        $pacientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pacientes;
    }
    public function agregar($nombre,  $apellido, $ci, $telefono, $email, $fecha){
        $sql = "INSERT INTO repuesto VALUES(0, '$nombre' '$apellido', $ci, $telefono, '$email' , '$fecha');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){
        $sql = "DELETE FROM repuesto WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha){
        $sql = "UPDATE repuesto SET nombre=$nombre, apellido=$apellido, ci=$ci, telefono=$telefono, email=$email, fecha=$fecha WHERE id= $id;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>