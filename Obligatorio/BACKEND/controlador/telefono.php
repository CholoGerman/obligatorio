<?php
require_once '../modelo/cliente_telefonoDAO.php';

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
    $resultado = (new cliente_telefono())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $id_cliente = $_POST['id_cliente'];
    $telefono = $_POST['telefono'];
    $resultado = (new cliente_telefono())->agregar( $id_cliente, $telefono);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_registro = $_POST['id_registro'];
    $resultado = (new cliente_telefono())->eliminar($id_registro);
    echo json_encode($resultado);
}


function editar()
{
    $id_registro = $_POST['id_registro'];
    $id_cliente = $_POST['id_cliente'];
    $telefono = $_POST['telefono'];
    $resultado = (new cliente_telefono())->editar($id_registro, $id_cliente, $telefono);
    echo json_encode($resultado);
}