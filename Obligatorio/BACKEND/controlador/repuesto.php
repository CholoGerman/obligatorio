<?php
require_once '../modelo/repuestoDAO.php';

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
    $resultado = (new repuesto())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $estado = $_POST['estado'];  
    $id_vehiculo = $_POST['id_vehiculo'];       
    $resultado = (new repuesto())->agregar($tipo, $precio, $color, $estado, $id_vehiculo);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_repuesto = $_POST['id_repuesto'];
    $resultado = (new repuesto())->eliminar($id_repuesto);
    echo json_encode($resultado);
}


function editar()
{
    $id_repuesto = $_POST['id_repuesto'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $estado = $_POST['estado'];
    $id_vehiculo = $_POST['id_vehiculo'];
    $resultado = (new repuesto())->editar($id_repuesto, $tipo, $precio, $color, $estado,$id_vehiculo);
    echo json_encode($resultado);
}