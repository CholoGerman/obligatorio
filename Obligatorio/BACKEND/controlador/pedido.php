<?php
require_once '../modelo/pedidoDAO.php';

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
    $resultado = (new pedido())->obtener();
    echo json_encode($resultado);
}
function agregar()
{

    $fecha = $_POST['fecha'];
    $metodo_pago = $_POST['metodo_pago'];
    $ID_cliente = $_POST['ID_cliente'];
    $resultado = (new pedido())->agregar($fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
function eliminar()
{
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new pedido())->eliminar($id_pedido);
    echo json_encode($resultado);
}


function editar()
{
    $id_pedido = $_POST['id_pedido'];
    $fecha = $_POST['fecha'];
    $metodo_pago = $_POST['cedula'];
    $ID_cliente = $_POST['ID_cliente'];
    $resultado = (new pedido())->editar($id_pedido, $fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
