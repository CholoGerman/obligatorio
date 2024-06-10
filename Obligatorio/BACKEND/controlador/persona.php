<?php
require_once '../modelo/personaDAO.php';

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
    $resultado = (new persona())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_ciudad = $_POST['id_ciudad'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $codigo_postal = $_POST['codigo_postal'];
    $resultado = (new persona())->agregar($nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_persona = $_POST['id_persona'];
    $resultado = (new persona())->eliminar($id_persona);
    echo json_encode($resultado);
}


function editar()
{
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_ciudad = $_POST['id_ciudad'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $codigo_postal = $_POST['codigo_postal'];
    $resultado = (new persona())->editar($id_persona, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}