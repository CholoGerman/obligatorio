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
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $precio_total = $_POST['precio_total'];
    $id_repuesto = $_POST['id_repuesto'];     
    $id_pedido = $_POST['id_pedido'];
    $fecha = $_POST['fecha'];
    $resultado = (new detalle())->agregar($cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido, $fecha);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_detalle = $_POST['id_detalle'];
    $resultado = (new detalle())->eliminar($id_detalle);
    echo json_encode($resultado);
}


function editar()
{
    $id_detalle = $_POST['id_detalle'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $precio_total = $_POST['precio_total'];
    $ID_repuesto = $_POST['ID_repuesto'];
    $ID_pedido = $_POST['ID_pedido'];
    $resultado = (new detalle())->editar($id_detalle, $cantidad, $precio_unitario, $precio_total, $ID_repuesto, $ID_pedido);
    echo json_encode($resultado);
}