<?php
require_once "../conexion/conexion.php";

class UsuarioDao{

function obtenerUsuarios(){
    $connection = connection();
    $sql = "SELECT * FROM Usuario";
    $respuesta = $connection->query($sql);
    $Usuario = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $Usuario;

}


function eliminarUsuario($correo){
    $sql = "DELETE FROM Usuario WHERE correo = $correo;";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    
return new Respuesta(true,"Eliminado correctamente",null);
}

}