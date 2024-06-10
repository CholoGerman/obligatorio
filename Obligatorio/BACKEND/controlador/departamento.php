<?php
require_once '../modelo/departamentoDAO.php';

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
    $resultado = (new departamento())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $nombre_depto_depto = $_POST['nombre_depto_depto'];
    $resultado = (new departamento())->agregar($nombre_depto_depto);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_depto = $_POST['id_depto'];
    $resultado = (new departamento())->eliminar($id_depto);
    echo json_encode($resultado);
}


function editar()
{
    $id_depto = $_POST['id_depto'];
    $nombre_depto = $_POST['nombre_depto'];
    $resultado = (new departamento())->editar($id_depto, $nombre_depto);
    echo json_encode($resultado);
}