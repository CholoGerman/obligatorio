<?php
require_once '../conexion/conexion.php';

class detalle
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM detalle ";
        $respuesta = $connection->query($sql);
        $pacientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pacientes;
    }
    public function agregar($nombre,  $apellido, $ci, $telefono, $email, $fecha){
        $sql = "INSERT INTO detalle VALUES(0, '$nombre' '$apellido', $ci, $telefono, '$email' , '$fecha');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){
        $sql = "DELETE FROM detalle WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha){
        $sql = "UPDATE detalle SET nombre=$nombre, apellido=$apellido, ci=$ci, telefono=$telefono, email=$email, fecha=$fecha WHERE id= $id;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}