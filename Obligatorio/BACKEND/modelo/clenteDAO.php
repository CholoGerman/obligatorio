<?php
require_once '../conexion/conexion.php';

class cliente
{

    function obtener(){
        $connection = connection();
        $sql = "SELECT * FROM cliente ";
        $respuesta = $connection->query($sql);
        $clientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $clientes;
    }
    public function agregar($usuario, $contrasenia, $ID_persona, $nombre, $apellido){
        $sql = "INSERT INTO cliente VALUES(0, '$usuario' '$contrasenia', $ID_persona, '$nombre', '$apellido');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID_cliente){
        $sql = "DELETE FROM cliente WHERE ID_cliente= $ID_cliente;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_cliente, $nombre, $apellido, $ci, $telefono, $email, $fecha){
        $sql = "UPDATE cliente SET nombre=$nombre, apellido=$apellido, ci=$ci, telefono=$telefono, email=$email, fecha=$fecha WHERE ID_cliente= $ID_cliente;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
