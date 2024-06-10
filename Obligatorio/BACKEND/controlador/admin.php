<?php
require_once '../modelo/adminDAO.php';

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
    $resultado = (new admin())->obtener();
    echo json_encode($resultado);
}
function agregar(){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $resultado = (new admin())->agregar($usuario, $contrasenia, $id_persona);
    echo json_encode($resultado);
}
function eliminar(){
    $id_admin = $_POST['id_admin'];
    $resultado = (new admin())->eliminar($id_admin);
    echo json_encode($resultado);
}


function editar(){
   $id_admin = $_POST['id_admin'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $resultado = (new admin())->editar( $id_admin, $usuario, $contrasenia, $id_persona);
    echo json_encode($resultado);
}
?>