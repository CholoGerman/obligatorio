<?php
require_once '../modelo/clienteDAO.php'; //Indicamos que necesitamos del archivo clienteDAO.php

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
function obtener(){ //Funcion para mostrar los clientes
    $resultado = (new cliente())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo cliente
    $usuario = $_GET['usuario'];
    $contrasenia = $_GET['contrasenia'];
    $id_persona = $_GET['id_persona'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $resultado = (new cliente())->agregar($usuario, $contrasenia, $id_persona, $nombre, $apellido);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un cliente
    $id_cliente = $_GET['id_cliente'];
    $resultado = (new cliente())->eliminar($id_cliente);
    echo json_encode($resultado);
}


function editar(){ //FUncion para editar un cliente
    $id_cliente = $_GET['id_cliente'];
    $usuario = $_GET['usuario'];
    $contrasenia = $_GET['contrasenia'];
    $id_persona = $_GET['id_persona'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $fecha = $_GET['fecha'];
    $resultado = (new cliente())->editar($id_cliente, $usuario, $contrasenia, $id_persona, $nombre, $apellido, $fecha);
    echo json_encode($resultado);
}
?>