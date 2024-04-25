<?php
require_once '../conexion/conexion.php';

class usuario
{

    function obtenerUsuariosModelo($user, $pass)
    {
        $connection = connection();
        $sql = "SELECT * FROM Usuario WHERE nombre='$user' AND contraseña='$pass' ;";
        $respuesta = $connection->query($sql);
        $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $usuarios;
    }
    public function agregarUsuario($user, $password, $tipo){
        $sql = "INSERT INTO usuario VALUES(0, '$user', '$password', '$tipo');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminarUsuario($id){
        $sql = "DELETE FROM usuario WHERE id= $id;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

}

?>
