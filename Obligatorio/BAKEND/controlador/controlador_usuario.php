<?php

require_once '../modelo/usuario_modelo.php';

$funcion = $_GET['funcion'];

switch ($funcion) {

    case "agregar";
        agregarUsuario();
        break;

    case "eliminar";
       eliminarUsuario();
        break;

    case "obtener";
        obtenerUsuario();
        break;
}
function obtenerUsuario(){
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $resultado = (new usuario())->obtenerUsuariosModelo($user, $pass);
    echo json_encode($resultado);
}
function agregarUsuario(){
    $user = $_POST['user'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];
    $resultado = (new usuario())->agregarUsuario($user, $password, $tipo);   
    echo json_encode($resultado) ;
}
function eliminarUsuario(){
    $id = $_POST['id'];
    $resultado = (new usuario())->eliminarUsuario($id);   
    echo json_encode($resultado) ;
}

?>