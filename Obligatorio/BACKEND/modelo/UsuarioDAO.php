<?php
require_once "../conexion/conexion.php";

class UsuarioDao{
 
function obtenerUsuarios(){ //Funcion para mostrar los clientes
    $connection = connection();
    $sql = "SELECT * FROM Usuario;";
    $respuesta = $connection->query($sql);
    $Usuario = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $Usuario;

}


function eliminarUsuario($correo){ //Funcion para eliminar un cliente
    $sql = "DELETE FROM Usuario WHERE correo = '$correo';";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    return new Respuesta(true,"Eliminado correctamente",null);
}

}