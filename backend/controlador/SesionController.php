<?php
require_once "../modelo/SesionDAO.php"; // Incluye el modelo de acceso a datos

// Captura la función que se desea ejecutar desde la URL
$funcion = $_GET["funcion"]; // Obtiene el valor de "funcion" de la URL

// Determina qué función ejecutar según el valor de "funcion"
switch ($funcion) {
    case "register":
        register(); // Llama a la función de registro
        break;
    case "registerAdmin":
        registerAdmin(); // Llama a la función de registro de administradores
        break;
    case "login":
        login(); // Llama a la función de inicio de sesión
        break;
    case "logOut":
        logOut(); // Llama a la función para cerrar sesión
        break;
    default:
        // Respuesta por defecto si la función no es válida
        echo json_encode(["status" => false, "mensaje" => "Función no válida."]);
        break;
}

// Función para registrar un nuevo cliente
function register() {
    // Captura los datos del formulario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    // Llama a la función para registrar al cliente en el modelo
    $respuesta = (new SesionDao())->register($correo, $contraseña, $nombre, $apellido);
    echo json_encode($respuesta); // Devuelve la respuesta en formato JSON
}

// Función para verificar si la sesión actual es de un administrador
function isAdminSession() {
    // Verifica si hay una sesión activa y si el usuario es administrador
    return isset($_SESSION["session"]) && isAdmin($_SESSION["session"]["id_persona"]);
}

// Función para verificar si un usuario es administrador
function isAdmin($idPersona) {
    $connection = connection(); // Conexión a la base de datos
    // Consulta para verificar si el usuario es administrador
    $sql = "SELECT * FROM admin WHERE id_persona = $idPersona";
    return $connection->query($sql)->num_rows > 0; // Devuelve true si es administrador
}

// Función para registrar un administrador
function registerAdmin() {
    // Captura los datos del formulario
    $correo = $_POST["correo"];
    $contraseña = password_hash($_POST["contraseña"] ?? '', PASSWORD_BCRYPT); // Hash de la contraseña
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    $connection = connection(); // Conexión a la base de datos

    // Inserta el nuevo usuario en la tabla persona
    $connection->query("INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES ('$correo', '$contraseña', '$nombre', '$apellido')");
    $id_persona = $connection->insert_id; // Obtiene el ID del nuevo usuario

    // Inserta el ID en la tabla admin
    $connection->query("INSERT INTO admin (id_persona) VALUES ('$id_persona')");

    // Retorna una respuesta de éxito en formato JSON
    echo jsonResponse(true, "Administrador registrado correctamente.");
}

// Función para iniciar sesión
function login() {
    // Captura los datos del formulario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    // Verifica que los datos no estén vacíos
    if (empty($correo) || empty($contraseña)) {
        return jsonResponse(false, "Correo y contraseña son requeridos."); // Respuesta si faltan datos
    }

    // Llama a la función de inicio de sesión en el modelo
    $respuesta = (new SesionDao())->login($correo, $contraseña);

    // Si el inicio de sesión es exitoso, verifica si el usuario es administrador
    if ($respuesta->status) {
        $isAdmin = isAdmin($respuesta->datos['id_persona']); // Verifica si es admin
        $respuesta->datos['isAdmin'] = $isAdmin; // Añade el estado de admin a los datos
    }

    echo json_encode($respuesta); // Devuelve la respuesta en formato JSON
}

// Función para cerrar sesión
function logOut() {
    $respuesta = (new SesionDao())->logOut(); // Llama a la función de cerrar sesión en el modelo
    echo json_encode($respuesta); // Devuelve la respuesta en formato JSON
}

// Función para retornar respuestas en formato JSON
function jsonResponse($status, $mensaje) {
    echo json_encode(["status" => $status, "mensaje" => $mensaje]); // Retorna la respuesta JSON
}
