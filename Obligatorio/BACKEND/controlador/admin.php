<?php
require_once '../modelo/adminDAO.php'; //Indicamos que necesitamos del archivo adminDAO.php

$funcion = $_GET['funcion']; //Declaramos que vamos a recibir la funcion del CRUD mediante GET

switch ($funcion) { //Utilizamos switch para crear los distintos casos de la funcion

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
function obtener(){ //Funcion para mostrar los admin
    $resultado = (new admin())->obtener(); 
    echo json_encode($resultado);
}
function agregar(){ //Funcion que recibe los parametros y los envia al modelo //
    $usuario = $_GET['usuario'];
    $contrasenia = $_GET['contrasenia'];
    $ID_persona = $_GET['ID_persona'];
    $resultado = (new admin())->agregar($usuario, $contrasenia, $ID_persona);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un admin
    $id_admin = $_GET['id_admin'];
    $resultado = (new admin())->eliminar($id_admin);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un admin
   $id_admin = $_GET['id_admin'];
    $usuario = $_GET['usuario'];
    $contrasenia = $_GET['contrasenia'];
    $ID_persona = $_GET['ID_persona'];
    $resultado = (new admin())->editar($id_admin, $usuario, $contrasenia, $ID_persona);
    echo json_encode($resultado);
}
?>