<?php
require_once '../modelo/personaDAO.php'; //Indicamos que necesitamos del archivo personaDAO.php

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
function obtener(){ //Funcion para mostrar las personas
    $resultado = (new persona())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar una nueva persona
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $id_ciudad = $_GET['id_ciudad'];
    $calle_dir = $_GET['calle_dir'];
    $num_dir = $_GET['num_dir'];
    $codigo_postal = $_GET['codigo_postal'];
    $resultado = (new persona())->agregar($nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar una persona
    $id_persona = $_GET['id_persona'];
    $resultado = (new persona())->eliminar($id_persona);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar una persona
    $id_persona = $_GET['id_persona'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $id_ciudad = $_GET['id_ciudad'];
    $calle_dir = $_GET['calle_dir'];
    $num_dir = $_GET['num_dir'];
    $codigo_postal = $_GET['codigo_postal'];
    $resultado = (new persona())->editar($id_persona, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}