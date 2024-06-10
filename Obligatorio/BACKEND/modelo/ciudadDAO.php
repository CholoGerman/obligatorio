<?php
require_once '../conexion/conexion.php';

class ciudad
{

    function obtener() {
        $connection = connection();
        $sql = "SELECT * FROM ciudad ";
        $respuesta = $connection->query($sql);
        $ciudades = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $ciudades;
    }
    public function agregar($nombre_ciudad, $ID_depto)  {
        $sql = "INSERT INTO ciudad VALUES(0, $nombre_ciudad, $ID_depto);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID_ciudad) {
        $sql = "DELETE FROM ciudad WHERE ID_ciudad= $ID_ciudad;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_ciudad, $nombre_ciudad, $ID_depto)  {
        $sql = "UPDATE ciudad SET ID_ciudad=$ID_ciudad, nombre_ciudad=$nombre_ciudad, ID_depto=$ID_depto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
