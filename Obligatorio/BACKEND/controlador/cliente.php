<?php
require_once '../modelo/clienteDAO.php'; //Indicamos que necesitamos del archivo clienteDAO.php

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
function obtener(){ //Funcion para mostrar los clientes
    $resultado = (new cliente())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo cliente
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $resultado = (new cliente())->agregar($usuario, $contrasenia, $id_persona, $nombre, $apellido);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un cliente
    $id_cliente = $_POST['id_cliente'];
    $resultado = (new cliente())->eliminar($id_cliente);
    echo json_encode($resultado);
}


function editar(){ //FUncion para editar un cliente
    $id_cliente = $_POST['id_cliente'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $resultado = (new cliente())->editar($id_cliente, $usuario, $contrasenia, $id_persona, $nombre, $apellido, $fecha);
    echo json_encode($resultado);
}
?>