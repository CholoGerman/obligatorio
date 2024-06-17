<?php
require_once '../modelo/departamentoDAO.php'; //Indicamos que necesitamos del archivo departamentoDAO.php

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
function obtener(){ //Funcion para mostrar los departamentos
    $resultado = (new departamento())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo departamento
    $nombre_depto_depto = $_GET['nombre_depto_depto'];
    $resultado = (new departamento())->agregar($nombre_depto_depto);
    echo json_encode($resultado);
}
function eliminar()
{ //Funcion para eliminar un departamento
    $id_depto = $_GET['id_depto'];
    $resultado = (new departamento())->eliminar($id_depto);
    echo json_encode($resultado);
}


function editar()
{ //Funcion para editar un departamento
    $id_depto = $_GET['id_depto'];
    $nombre_depto = $_GET['nombre_depto'];
    $resultado = (new departamento())->editar($id_depto, $nombre_depto);
    echo json_encode($resultado);
}