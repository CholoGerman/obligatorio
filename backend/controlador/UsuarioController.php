<?php
require_once "../modelo/UsuarioDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
    case "obtener":
        obtenerUsuarios();
        break;
    case "eliminar":
        eliminarUsuario();
        break;
   
}


function obtenerUsuarios(){ //Funcion para mostrar los clientes
    $respuesta = (new UsuarioDao())->obtenerUsuarios();
    echo json_encode($respuesta);

}


function eliminarUsuario(){ //Funcion para eliminar un cliente
    $correo = $_POST["email"];
    $respuesta = (new UsuarioDao())->eliminarUsuario($correo);
    echo json_encode($respuesta);
    
}
