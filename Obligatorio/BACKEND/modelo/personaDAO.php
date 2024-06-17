<?php
require_once '../conexion/conexion.php';

class persona
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar las personas
        $connection = connection();
        $sql = "SELECT * FROM persona ";
        $respuesta = $connection->query($sql);
        $personas = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $personas;
    }
    public function agregar($nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal){  //Funcion que indica los parametros y consulta sql a utilizar para agregar una persona 
        $sql = "INSERT INTO persona VALUES(0, '$nombre', '$apellido', $id_ciudad, '$calle_dir', '$num_dir', $codigo_postal);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar una persona 
        $sql = "DELETE FROM persona WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_persona, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal){  //Funcion que indica los parametros y consulta sql a utilizar para editar una persona 
        $sql = "UPDATE persona SET nombre='$nombre', apellido='$apellido', id_ciudad=$id_ciudad, calle_dir='$calle_dir', num_dir='$num_dir', codigo_postal=$codigo_postal WHERE id_persona= $id_persona;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}