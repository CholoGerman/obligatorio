<?php
require_once '../modelo/envioDAO.php'; //Indicamos que necesitamos del archivo envioDAO.php

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
function obtener(){ //Funcion para mostrar los envios
    $resultado = (new envio())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo envio
    $fecha_envio = $_GET['fecha_envio'];
    $peso = $_GET['peso'];
    $costo = $_GET['costo'];
    $id_ciudad = $_GET['id_ciudad'];
    $codigo_postal = $_GET['codigo_postal'];
    $calle_dir = $_GET['calle_dir'];
    $num_dir = $_GET['num_dir'];
    $id_pedido = $_GET['id_pedido'];
    $resultado = (new envio())->agregar($fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un envio
    $id_envio = $_GET['id_envio'];
    $resultado = (new envio())->eliminar($id_envio);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un envio
    $id_envio = $_GET['id_envio'];
    $fecha_envio = $_GET['fecha_envio'];
    $peso = $_GET['peso'];
    $costo = $_GET['costo'];
    $id_ciudad = $_GET['id_ciudad'];
    $codigo_postal = $_GET['codigoget$_GETal'];
    $calle_dir = $_GET['calle_dir'];
    $num_dir = $_GET['num_dir'];
    $id_pedido = $_GET['id_pedido'];
    $resultado = (new envio())->editar($id_envio, $fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}