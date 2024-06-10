<?php
require_once '../modelo/vehiculoDAO.php';

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
    $resultado = (new vehiculo())->obtener();
    echo json_encode($resultado);
}
function agregar(){
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];       
    $resultado = (new vehiculo())->agregar($marca, $modelo, $anio);
    echo json_encode($resultado);
}
function eliminar(){
    $id_vehiculo = $_POST['id_vehiculo'];
    $resultado = (new vehiculo())->eliminar($id_vehiculo);
    echo json_encode($resultado);
}


function editar(){
    $id_vehiculo = $_POST['id_vehiculo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $resultado = (new vehiculo())->editar($id_vehiculo, $marca, $modelo, $anio);
    echo json_encode($resultado);
}