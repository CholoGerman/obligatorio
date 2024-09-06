<?php
require_once "../conexion/conexion.php";

class SesionDao{
function register($usuario, $email, $password){
    $sql = "INSERT INTO cliente(usuario, email, contrasenia) VALUES( '$usuario', '$email', '$password');";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    return new Respuesta(true, "agregado correctamente", null);

}


function login(){



}



function logOut(){


    
}

}