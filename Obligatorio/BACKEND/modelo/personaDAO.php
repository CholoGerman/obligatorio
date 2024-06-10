<?php
require_once '../conexion/conexion.php';

class persona
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM persona ";
        $respuesta = $connection->query($sql);
        $pacientes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pacientes;
    }
    public function agregar($nombre, $apellido, $ID_ciudad, $calle_dir, $num_dir, $codigo_postal){
        $sql = "INSERT INTO persona VALUES(0, $nombre, $apellido, $ID_ciudad, $calle_dir, $num_dir, $codigo_postal);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){
        $sql = "DELETE FROM persona WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_persona, $nombre, $apellido, $ID_ciudad, $calle_dir, $num_dir, $codigo_postal){
        $sql = "UPDATE persona SET nombre=$nombre, apellido=$apellido, ID_ciudad=$ID_ciudad, calle_dir=$calle_dir, num_dir=$num_dir, codigo_postal=$codigo_postal WHERE ID_persona= $ID_persona;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}