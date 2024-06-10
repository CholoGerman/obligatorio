<?php
require_once '../conexion/conexion.php';

class departamento
{

    function obtener() {
        $connection = connection();
        $sql = "SELECT * FROM departamento ";
        $respuesta = $connection->query($sql);
        $departamentos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $departamentos;
    }
    public function agregar($nombre_depto){
        $sql = "INSERT INTO departamento VALUES(0, $nombre_depto);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID_depto) {
        $sql = "DELETE FROM departamento WHERE ID_depto= $ID_depto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_depto,$nombre_depto) {
        $sql = "UPDATE departamento SET ID_depto=$ID_depto, nombre_depto=$nombre_depto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}