<?php
require_once '../modelo/envioDAO.php';

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
    $resultado = (new envio())->obtener();
    echo json_encode($resultado);
}
function agregar()
{
    $fecha_envio = $_POST['fecha_envio'];
    $peso = $_POST['peso'];
    $costo = $_POST['costo'];
    $id_ciudad = $_POST['id_ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new envio())->agregar($fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}
function eliminar(){
    $id_envio = $_POST['id_envio'];
    $resultado = (new envio())->eliminar($id_envio);
    echo json_encode($resultado);
}


function editar(){
    $id_envio = $_POST['id_envio'];
    $fecha_envio = $_POST['fecha_envio'];
    $peso = $_POST['peso'];
    $costo = $_POST['costo'];
    $id_ciudad = $_POST['id_ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new envio())->editar($id_envio, $fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}