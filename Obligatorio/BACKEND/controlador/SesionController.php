<?php
require_once "../modelo/SesionDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) {
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

function register() {
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $respuesta = (new SesionDao())->register($usuario,$correo, $password,);
    echo json_encode($respuesta);
}


function login() {
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $respuesta = (new SesionDao())->login($correo, $password);
    echo json_encode($respuesta);
    
  
  
}



function logOut() {

}
