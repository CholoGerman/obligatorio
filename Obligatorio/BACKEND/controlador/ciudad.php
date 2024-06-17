<?php 
require_once '../modelo/ciudadDAO.php'; //Indicamos que necesitamos del archivo ciudadDAO.php

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
function obtener(){ //Funcion para mostrar las ciudades
    $resultado = (new ciudad())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar una nueva ciudad
    $nombre_ciudad = $_GET['nombre_ciudad'];
    $id_depto = $_GET['id_depto'];
    $resultado = (new ciudad())->agregar($nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar una ciudad
    $id_ciudad = $_GET['id_ciudad'];
    $resultado = (new ciudad())->eliminar($id_ciudad);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar una ciudad
    $id_ciudad = $_GET['id_ciudad'];
    $nombre_ciudad = $_GET['nombre_ciudad'];
    $id_depto = $_GET['id_depto'];
    $resultado = (new ciudad())->editar($id_ciudad, $nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
?>