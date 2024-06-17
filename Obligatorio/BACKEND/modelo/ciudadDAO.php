<?php
require_once '../conexion/conexion.php';

class ciudad
{

    function obtener() { //Funcion que indica la consulta sql a utilizar para mostrar las ciudades
        $connection = connection();
        $sql = "SELECT * FROM ciudad ";
        $respuesta = $connection->query($sql);
        $ciudades = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $ciudades;
    }
    public function agregar($nombre_ciudad, $id_depto)  { //Funcion que indica los parametros y consulta sql a utilizar para agregar una ciudad
        $sql = "INSERT INTO ciudad VALUES(0, '$nombre_ciudad', $id_depto);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_ciudad) { //Funcion que indica los parametros y consulta sql a utilizar para eliminar una ciudad
        $sql = "DELETE FROM ciudad WHERE id_ciudad= $id_ciudad;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_ciudad, $nombre_ciudad, $id_depto)  {  //Funcion que indica los parametros y consulta sql a utilizar para editar una ciudad
        $sql = "UPDATE ciudad SET nombre_ciudad='$nombre_ciudad', id_depto=$id_depto WHERE id_ciudad=$id_ciudad;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
