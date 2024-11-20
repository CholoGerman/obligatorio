<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require_once "../modelo/UsuarioDAO.php";

$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
    case "obtenerAll":
        obtenerUsuarios();
        break;
        case "obtener":
            obtenerUsuario();
            break;
    case "eliminar":
        eliminarUsuario();
        break;
   
}


function obtenerUsuarios(){ //Funcion para mostrar los clientes
    $respuesta = (new UsuarioDao())->obtenerUsuarios();
    echo json_encode($respuesta);


}
function obtenerUsuario(){ //Funcion para mostrar los clientes
    $id_cliente = $_GET['id_cliente']; // Obtén el ID del cliente
    $clienteDAO = new UsuarioDao();
    $cliente = $clienteDAO->obtenerClientePorId($id_cliente);
    
    header('Content-Type: application/json');
    echo json_encode($cliente);

}


function eliminarUsuario(){ //Funcion para eliminar un cliente
    $correo = $_POST["correo"];
    $respuesta = (new UsuarioDao())->eliminarUsuario($correo);
    echo json_encode($respuesta);
    
}
