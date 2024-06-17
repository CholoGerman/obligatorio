<?php
require_once '../conexion/conexion.php';

class cliente_telefono
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los telefonos
        $connection = connection();
        $sql = "SELECT * FROM cliente_telefono ";
        $respuesta = $connection->query($sql);
        $telefonos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $telefonos;
    }
    public function agregar($id_cliente, $telefono){ //Funcion que indica los parametros y consulta sql a utilizar para agregar un telefono
        $sql = "INSERT INTO cliente_telefono VALUES(0, $id_cliente, '$telefono');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_registro){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar un telefono
        $sql = "DELETE FROM cliente_telefono WHERE id_registro= $id_registro;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_registro, $id_cliente, $telefono){  //Funcion que indica los parametros y consulta sql a utilizar para editar un telefono
        $sql = "UPDATE cliente_telefono SET id_cliente=$id_cliente, telefono='$telefono' WHERE id_registro= $id_registro;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}