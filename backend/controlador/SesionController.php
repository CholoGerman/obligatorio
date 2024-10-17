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

function register() { // Función para registrar un usuario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $respuesta = (new SesionDao())->register($correo, $contraseña, $nombre, $apellido);
    echo json_encode($respuesta);
}

function login() { // Función para iniciar sesión
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $respuesta = (new SesionDao())->login($correo, $contraseña);
    echo json_encode($respuesta);
}

function logOut() { // Función para cerrar sesión
    $respuesta = (new SesionDao())->logOut();
    echo json_encode($respuesta);
}

