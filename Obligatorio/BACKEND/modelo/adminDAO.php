<?php
require_once '../conexion/conexion.php';

class admin
{

    function obtener(){
        $connection = connection();
        $sql = "SELECT * FROM admin ";
        $respuesta = $connection->query($sql);
        $admins = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $admins;
    }
    public function agregar($usuario, $contrasenia, $ID_persona) {
        $sql = "INSERT INTO admin VALUES(0,  '$usuario', '$contrasenia', $ID_persona);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID) {
        $sql = "DELETE FROM admin WHERE ID= $ID;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_admin, $usuario, $contrasenia, $ID_persona) {
        $sql = "UPDATE admin SET usuario=$usuario, contrasenia=$contrasenia, ID_persona=$ID_persona WHERE ID_admin=$ID_admin;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>

