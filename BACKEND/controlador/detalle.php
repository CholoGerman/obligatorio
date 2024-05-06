<?php
require_once '../modelo/detalleDAO.php';

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
    $resultado = (new detalle())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['cedula'];
    $telefono = $_POST['telefono'];        //editar los atributos con sus correspondientes
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $resultado = (new detalle())->agregar($nombre, $apellido, $ci, $telefono, $email, $fecha);
    echo json_encode($resultado);
}
function eliminar()
{
    $id = $_POST['id'];
    $resultado = (new detalle())->eliminar($id);
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
    $resultado = (new detalle())->editar($id, $nombre, $apellido, $ci, $telefono, $email, $fecha);
    echo json_encode($resultado);
}