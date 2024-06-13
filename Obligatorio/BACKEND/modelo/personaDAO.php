<?php
require_once '../conexion/conexion.php';

class persona
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM persona ";
        $respuesta = $connection->query($sql);
        $personas = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $personas;
    }
    public function agregar($nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal){ 
        $sql = "INSERT INTO persona VALUES(0, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);";
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

    public function editar($id_persona, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal){
        $sql = "UPDATE persona SET nombre=$nombre, apellido=$apellido, id_ciudad=$id_ciudad, calle_dir=$calle_dir, num_dir=$num_dir, codigo_postal=$codigo_postal WHERE id_persona= $id_persona;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}