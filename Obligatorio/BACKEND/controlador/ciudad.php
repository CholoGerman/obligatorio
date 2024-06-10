<?php
require_once '../modelo/ciudadDAO.php';

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
    $resultado = (new ciudad())->obtener();
    echo json_encode($resultado);
}
function agregar(){
    $nombre_ciudad = $_POST['nombre_ciudad'];
    $id_depto = $_POST['id_depto'];
    $resultado = (new ciudad())->agregar($nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
function eliminar(){
    $id_ciudad = $_POST['id_ciudad'];
    $resultado = (new ciudad())->eliminar($id_ciudad);
    echo json_encode($resultado);
}


function editar(){
    $id_ciudad = $_POST['id_ciudad'];
    $nombre_ciudad = $_POST['nombre_ciudad'];
    $id_depto = $_POST['id_depto'];
    $resultado = (new ciudad())->editar($id_ciudad, $nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
?>