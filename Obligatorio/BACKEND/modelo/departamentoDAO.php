<?php
require_once '../conexion/conexion.php';

class departamento
{

    function obtener() { //Funcion que indica la consulta sql a utilizar para mostrar los departamentos
        $connection = connection();
        $sql = "SELECT * FROM departamento ";
        $respuesta = $connection->query($sql);
        $departamentos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $departamentos;
    }
    public function agregar($nombre_depto){ //Funcion que indica los parametros y consulta sql a utilizar para agregar un departamento
        $sql = "INSERT INTO departamento VALUES(0, '$nombre_depto');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_depto) { //Funcion que indica los parametros y consulta sql a utilizar para eliminar un departamento
        $sql = "DELETE FROM departamento WHERE id_depto= $id_depto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    

    public function editar($id_depto,$nombre_depto) {  //Funcion que indica los parametros y consulta sql a utilizar para editar un departamento
        $sql = "UPDATE departamento SET nombre_depto='$nombre_depto' WHERE id_depto=$id_depto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}