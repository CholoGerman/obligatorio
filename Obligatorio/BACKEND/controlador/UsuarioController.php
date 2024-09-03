<?php

$funcion = $_GET["funcion"];
switch ($funcion) {
    case "obtener":
        obtenerUsuarios();
        break;
    case "eliminar":
        eliminarUsuario();
        break;
   
}


function obtenerUsuarios(){


}


function eliminarUsuario(){
    $correo = $_POST["email"];
 
    
}
