<?php
require_once "../conexion/conexion.php";
session_start();
class SesionDao{

function register($usuario, $email, $password){ //Funcion para registrar un usuario
    $hash = password_hash($password, PASSWORD_DEFAULT, [15]);
    $sql = "INSERT INTO cliente(usuario, email, contrasenia) VALUES( '$usuario', '$email', '$hash');";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    return new Respuesta(true, "agregado correctamente", null);

}


function login($correo, $password ){  //Funcion para iniciar sesion

    $sql=  "SELECT * FROM cliente WHERE correo='$correo'";
    $connection = connection();
    $respuesta = $connection->query($sql);
    $usuario = $respuesta->fetch_assoc();
    if($usuario && password_verify($password, $usuario['contrasenia'])) {
        $_SESSION["session"]=$usuario;
        return  new Respuesta(true, "agregado correctamente", null);
    }else {
        return  new Respuesta(true, "agregado correctamente", null);
    }

    }



function logOut(){  //Funcion para cerrar sesion
    $_SESSION["session"]=null;
    return  new Respuesta(true, "agregado correctamente", null);

    
}

}
