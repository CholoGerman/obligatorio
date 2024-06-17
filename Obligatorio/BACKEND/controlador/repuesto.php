<?php
require_once '../modelo/repuestoDAO.php'; //Indicamos que necesitamos del archivo repuestoDAO.php

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
function obtener(){ //Funcion para mostrar los repuestos
    $resultado = (new repuesto())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo repuesto
    $tipo = $_GET['tipo'];
    $precio = $_GET['precio'];
    $color = $_GET['color'];
    $estado = $_GET['estado'];  
    $id_vehiculo = $_GET['id_vehiculo'];       
    $resultado = (new repuesto())->agregar($tipo, $precio, $color, $estado, $id_vehiculo);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un repuesto
    $id_repuesto = $_GET['id_repuesto'];
    $resultado = (new repuesto())->eliminar($id_repuesto);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un repuesto
    $id_repuesto = $_GET['id_repuesto'];
    $tipo = $_GET['tipo'];
    $precio = $_GET['precio'];
    $color = $_GET['color'];
    $estado = $_GET['estado'];
    $id_vehiculo = $_GET['id_vehiculo'];
    $resultado = (new repuesto())->editar($id_repuesto, $tipo, $precio, $color, $estado,$id_vehiculo);
    echo json_encode($resultado);
}