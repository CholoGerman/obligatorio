<?php
require_once '../modelo/detalleDAO.php'; //Indicamos que necesitamos del archivo detalleDAO.php

$funcion = $_GET['funcion']; //Declaramos que vamos a recibir la funcion del CRUD mediante GET

switch ($funcion) { //Utilizamos switch para crear los distintos casos de la funcion

    case "agregar"; //En el caso de que la funcion sea "agregar" 
        agregar();  //Utilizar la funcion "agregar()"
        break; //Fin

    case "eliminar"; //En el caso de que la funcion sea "eliminar" 
        eliminar(); //Utilizar la funcion "eliminar()"
        break; //Fin

    case "obtener"; //En el caso de que la funcion sea "obtener" 
        obtener(); //Utilizar la funcion "obtener()"
        break;

    case "editar"; //En el caso de que la funcion sea "editar" 
        editar(); //Utilizar la funcion "editar()
        break; //Fin
}
function obtener() { //Funcion para mostrar los detalles del pedido
    $resultado = (new detalle())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo detalle del pedido
    $cantidad = $_POST['cantidad']; 
    $precio_unitario = $_POST['precio_unitario']; 
    $precio_total = $_POST['precio_total'];
    $id_repuesto = $_POST['id_repuesto'];      
    $id_pedido = $_POST['id_pedido'];
    $fecha = $_POST['fecha'];
    $resultado = (new detalle())->agregar($cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido, $fecha);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un detalle del pedido
    $id_detalle = $_POST['id_detalle'];
    $resultado = (new detalle())->eliminar($id_detalle);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un detalle del pedido
    $id_detalle = $_POST['id_detalle'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $precio_total = $_POST['precio_total'];
    $id_repuesto = $_POST['id_repuesto'];
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new detalle())->editar($id_detalle, $cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido);
    echo json_encode($resultado);
}