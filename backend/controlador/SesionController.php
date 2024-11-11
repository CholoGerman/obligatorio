<?php
session_start(); // Asegúrate de iniciar la sesión

require_once "../modelo/SesionDAO.php"; // Incluye el modelo de acceso a datos

$funcion = $_GET["funcion"]; // Obtiene el valor de "funcion" de la URL

switch ($funcion) {
    case "register":
        register();
        break;
    case "registerAdmin":
        registerAdmin();
        break;
    case "login":
        login();
        break;
    case "logOut":
        logOut();
        break;
    default:
        jsonResponse(false, "Función no válida.");
        break;
}

function register() {
    // Captura los datos del formulario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    $respuesta = (new SesionDao())->register($correo, $contraseña, $nombre, $apellido);
    jsonResponse($respuesta->status, $respuesta->mensaje);
}

function isAdminSession() {
    return isset($_SESSION["session"]) && isAdmin($_SESSION["session"]["id_persona"]);
}

function isAdmin($idPersona) {
    $connection = connection();
    $sql = "SELECT * FROM admin WHERE id_persona = $idPersona";
    return $connection->query($sql)->num_rows > 0;
}

function registerAdmin() {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    if (empty($correo) || empty($contraseña) || empty($nombre) || empty($apellido)) {
        jsonResponse(false, "Todos los campos son obligatorios.");
        return;
    }

    $respuesta = (new SesionDao())->registerAdmin($correo, $contraseña, $nombre, $apellido);
    jsonResponse($respuesta->status, $respuesta->mensaje);
}

function login() {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    if (empty($correo) || empty($contraseña)) {
        echo json_encode(["status" => false, "mensaje" => "Correo y contraseña son requeridos."]);
        return;
    }

    $respuesta = (new SesionDao())->login($correo, $contraseña);

    if ($respuesta->status) {
        $isAdmin = isAdmin($respuesta->datos['id_persona']);
        $respuesta->datos['isAdmin'] = $isAdmin;

        
    } else {
        error_log("Error de inicio de sesión para $correo: " . $respuesta->mensaje);
        echo json_encode(["status" => false, "mensaje" => $respuesta->mensaje]);
        return;
    }

    echo json_encode($respuesta);
}



function logOut() {
    $respuesta = (new SesionDao())->logOut();
    jsonResponse($respuesta->status, $respuesta->mensaje);
}

function jsonResponse($status, $mensaje) {
    echo json_encode(["status" => $status, "mensaje" => $mensaje]);
}
