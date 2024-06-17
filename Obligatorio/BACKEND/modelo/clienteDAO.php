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
    public function agregar($usuario, $contrasenia, $id_persona, $nombre, $apellido){
        $sql = "INSERT INTO cliente VALUES(0, '$usuario', '$contrasenia', $id_persona, '$nombre', '$apellido');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_cliente){
        $sql = "DELETE FROM cliente WHERE id_cliente= $id_cliente;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_cliente, $nombre, $apellido, $usuario, $contrasenia, /*$email, */ $id_persona){
        $sql = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', usuario='$usuario', contrasenia='$contrasenia', /*email */ id_persona=$id_persona WHERE id_cliente= $id_cliente;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
