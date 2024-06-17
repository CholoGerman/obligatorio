<?php
require_once '../conexion/conexion.php';

class admin
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los admins
        $connection = connection();
        $sql = "SELECT * FROM admin";
        $respuesta = $connection->query($sql);
        $admins = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $admins;
    }
    public function agregar($usuario, $contrasenia, $id_persona) { //Funcion que indica los parametros y consulta sql a utilizar para agregar un admin
        $sql = "INSERT INTO admin VALUES(0,  '$usuario', '$contrasenia', $id_persona);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_admin) { //Funcion que indica los parametros y consulta sql a utilizar para eliminar un admin
        $sql = "DELETE FROM admin WHERE id_admin=$id_admin;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_admin, $usuario, $contrasenia, $id_persona) { //Funcion que indica los parametros y consulta sql a utilizar para editar un admin
        $sql = "UPDATE admin SET usuario='$usuario', contrasenia='$contrasenia', id_persona=$id_persona WHERE id_admin=$id_admin;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}





?>