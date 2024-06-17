<?php
require_once '../modelo/pedidoDAO.php'; //Indicamos que necesitamos del archivo pedidoDAO.php

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
function obtener(){ //Funcion para mostrar los pedidos
    $resultado = (new pedido())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo pedido

    $fecha = $_GET['fecha'];
    $metodo_pago = $_GET['metodo_pago'];
    $ID_cliente = $_GET['ID_cliente'];
    $resultado = (new pedido())->agregar($fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un pedido
    $id_pedido = $_GET['id_pedido'];
    $resultado = (new pedido())->eliminar($id_pedido);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un pedido
    $id_pedido = $_GET['id_pedido'];
    $fecha = $_GET['fecha'];
    $metodo_pago = $_GET['cedula'];
    $ID_cliente = $_GET['ID_cliente'];
    $resultado = (new pedido())->editar($id_pedido, $fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
