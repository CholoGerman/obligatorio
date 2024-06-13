<?php
require_once '../modelo/envioDAO.php'; //Indicamos que necesitamos del archivo envioDAO.php

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
function obtener(){ //Funcion para mostrar los envios
    $resultado = (new envio())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo envio
    $fecha_envio = $_POST['fecha_envio'];
    $peso = $_POST['peso'];
    $costo = $_POST['costo'];
    $id_ciudad = $_POST['id_ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new envio())->agregar($fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un envio
    $id_envio = $_POST['id_envio'];
    $resultado = (new envio())->eliminar($id_envio);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un envio
    $id_envio = $_POST['id_envio'];
    $fecha_envio = $_POST['fecha_envio'];
    $peso = $_POST['peso'];
    $costo = $_POST['costo'];
    $id_ciudad = $_POST['id_ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new envio())->editar($id_envio, $fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir, $num_dir, $id_pedido);
    echo json_encode($resultado);
}