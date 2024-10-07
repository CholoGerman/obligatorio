<?php
require_once "../modelo/SesionDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
    case "register":
        register();
        break;
    case "login":
        login();
        break;
    case "logOut":
        logOut();
        break;
}

function register() { //Funcion para registrar un usuario
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $respuesta = (new SesionDao())->register($usuario,$correo, $password,);
    echo json_encode($respuesta);
}


function login() { //Funcion para iniciar sesion
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $respuesta = (new SesionDao())->login($correo, $password);
    echo json_encode($respuesta);
    
  
  
}



function logOut() { //Funcion para cerrar sesion
    $respuesta = (new SesionDao())->logOut();
    echo json_encode($respuesta);
}
