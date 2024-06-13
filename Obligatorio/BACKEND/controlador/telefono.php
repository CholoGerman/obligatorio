<?php
require_once '../modelo/cliente_telefonoDAO.php'; //Indicamos que necesitamos del archivo telefonoDAO.php

$funcion = $_GET['funcion']; //Declaramos que vamos a recibir la funcion del CRUD mediante GET

switch ($funcion) { //Utilizamos switch para crear los casos posibles de la funcion

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
function obtener(){ //Funcion para mostrar los telefonos
    $resultado = (new cliente_telefono())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo telefono
    $id_cliente = $_POST['id_cliente'];
    $telefono = $_POST['telefono'];
    $resultado = (new cliente_telefono())->agregar( $id_cliente, $telefono);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un telefono
    $id_registro = $_POST['id_registro'];
    $resultado = (new cliente_telefono())->eliminar($id_registro);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un telefono
    $id_registro = $_POST['id_registro'];
    $id_cliente = $_POST['id_cliente'];
    $telefono = $_POST['telefono'];
    $resultado = (new cliente_telefono())->editar($id_registro, $id_cliente, $telefono);
    echo json_encode($resultado);
}