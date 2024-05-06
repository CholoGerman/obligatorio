<?php
require_once '../conexion/conexion.php';

class cliente
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM cliente ";
        $respuesta = $connection->query($sql);
        $clientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $clientes;
    }
    public function agregar($nombre,  $apellido, $ci, $telefono, $email, $fecha){
        $sql = "INSERT INTO cliente VALUES(0, '$nombre' '$apellido', $ci, $telefono, '$email' , '$fecha');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){
        $sql = "DELETE FROM cliente WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha){
        $sql = "UPDATE cliente SET nombre=$nombre, apellido=$apellido, ci=$ci, telefono=$telefono, email=$email, fecha=$fecha WHERE id= $id;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
