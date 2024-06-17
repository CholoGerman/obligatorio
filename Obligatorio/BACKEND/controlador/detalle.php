<?php
require_once '../modelo/detalleDAO.php'; //Indicamos que necesitamos del archivo detalleDAO.php

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
function obtener() { //Funcion para mostrar los detalles del pedido
    $resultado = (new detalle())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo detalle del pedido
    $cantidad = $_GET['cantidad']; 
    $precio_unitario = $_GET['precio_unitario']; 
    $precio_total = $_GET['precio_total'];
    $id_repuesto = $_GET['id_repuesto'];      
    $id_pedido = $_GET['id_pedido'];
    $fecha = $_GET['fecha'];
    $resultado = (new detalle())->agregar($cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido, $fecha);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un detalle del pedido
    $id_detalle = $_GET['id_detalle'];
    $resultado = (new detalle())->eliminar($id_detalle);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un detalle del pedido
    $id_detalle = $_GET['id_detalle'];
    $cantidad = $_GET['cantidad'];
    $precio_unitario = $_GET['precio_unitario'];
    $precio_total = $_GET['precio_total'];
    $id_repuesto = $_GET['id_repuesto'];
    $id_pedido = $_GET['id_pedido'];
    $resultado = (new detalle())->editar($id_detalle, $cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido);
    echo json_encode($resultado);
}