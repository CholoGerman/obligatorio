<?php
require_once '../conexion/conexion.php';

class pedido
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM pedido ";
        $respuesta = $connection->query($sql);
        $pacientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pacientes;
    }
    public function agregar($nombre,  $apellido, $ci, $telefono, $email, $fecha){
        $sql = "INSERT INTO pedido VALUES(0, '$nombre' '$apellido', $ci, $telefono, '$email' , '$fecha');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){
        $sql = "DELETE FROM pedido WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha){
        $sql = "UPDATE pedido SET nombre=$nombre, apellido=$apellido, ci=$ci, telefono=$telefono, email=$email, fecha=$fecha WHERE id= $id;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>