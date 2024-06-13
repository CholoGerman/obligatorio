<?php
require_once '../modelo/personaDAO.php'; //Indicamos que necesitamos del archivo personaDAO.php

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
function obtener(){ //Funcion para mostrar las personas
    $resultado = (new persona())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar una nueva persona
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_ciudad = $_POST['id_ciudad'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $codigo_postal = $_POST['codigo_postal'];
    $resultado = (new persona())->agregar($nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar una persona
    $id_persona = $_POST['id_persona'];
    $resultado = (new persona())->eliminar($id_persona);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar una persona
    $id_persona = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $id_ciudad = $_POST['id_ciudad'];
    $calle_dir = $_POST['calle_dir'];
    $num_dir = $_POST['num_dir'];
    $codigo_postal = $_POST['codigo_postal'];
    $resultado = (new persona())->editar($id_persona, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal);
    echo json_encode($resultado);
}