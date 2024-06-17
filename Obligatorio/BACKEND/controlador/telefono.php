<?php
require_once '../modelo/cliente_telefonoDAO.php'; //Indicamos que necesitamos del archivo telefonoDAO.php

$funcion = $_GET['funcion']; //Declaramos que vamos a recibir la funcion del CRUD mediante GET

switch ($funcion) { //Utilizamos switch para crear los casos posibles de la funcion

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
function obtener(){ //Funcion para mostrar los telefonos
    $resultado = (new cliente_telefono())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo telefono
    $id_cliente = $_GET['id_cliente'];
    $telefono = $_GET['telefono'];
    $resultado = (new cliente_telefono())->agregar( $id_cliente, $telefono);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un telefono
    $id_registro = $_GET['id_registro'];
    $resultado = (new cliente_telefono())->eliminar($id_registro);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un telefono
    $id_registro = $_GET['id_registro'];
    $id_cliente = $_GET['id_cliente'];
    $telefono = $_GET['telefono'];
    $resultado = (new cliente_telefono())->editar($id_registro, $id_cliente, $telefono);
    echo json_encode($resultado);
}