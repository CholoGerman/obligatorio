<?php
require_once '../modelo/clienteDAO.php';

$funcion = $_GET['funcion'];

switch ($funcion) {

    case "agregar";
        agregar();
        break;

    case "eliminar";
        eliminar();
        break;
    case "obtener";
        obtener();
        break;
    case "editar";
        editar();
        break;
}
function obtener(){
    $resultado = (new cliente())->obtener();
    echo json_encode($resultado);
}
function agregar(){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $resultado = (new cliente())->agregar($usuario, $contrasenia, $id_persona, $nombre, $apellido);
    echo json_encode($resultado);
}
function eliminar(){
    $id_cliente = $_POST['id_cliente'];
    $resultado = (new cliente())->eliminar($id_cliente);
    echo json_encode($resultado);
}


function editar(){
    $id_cliente = $_POST['id_cliente'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $resultado = (new cliente())->editar($id_cliente, $usuario, $contrasenia, $id_persona, $nombre, $apellido, $fecha);
    echo json_encode($resultado);
}
?>