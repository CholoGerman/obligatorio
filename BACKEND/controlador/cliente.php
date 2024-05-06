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
function obtener()
{
    $resultado = (new cliente())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $resultado = (new cliente())->agregar($nombre, $apellido, $ci, $telefono, $email, $fecha);
    echo json_encode($resultado);
}
function eliminar()
{
    $id = $_POST['id'];
    $resultado = (new cliente())->eliminar($id);
    echo json_encode($resultado);
}


function editar()
{
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $resultado = (new cliente())->editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha);
    echo json_encode($resultado);
}