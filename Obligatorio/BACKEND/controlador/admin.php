<?php
require_once '../modelo/adminDAO.php'; //Indicamos que necesitamos del archivo adminDAO.php

$funcion = $_GET['funcion']; //Declaramos que vamos a recibir la funcion del CRUD mediante GET

switch ($funcion) { //Utilizamos switch para crear los distintos casos de la funcion

    case "agregar"; //En el caso de que la funcion sea "agregar" 
        agregar();  //Utilizar la funcion "agregar()"
        break; 

    case "eliminar"; //En el caso de que la funcion sea "eliminar" 
        eliminar(); //Utilizar la funcion "eliminar()"
        break; 

    case "obtener"; //En el caso de que la funcion sea "obtener" 
        obtener(); //Utilizar la funcion "obtener()"
        break;

    case "editar"; //En el caso de que la funcion sea "editar" 
        editar(); //Utilizar la funcion "editar()
        break; 
}
function obtener(){ //Funcion para mostrar los admin
    $resultado = (new admin())->obtener(); 
    echo json_encode($resultado);
}
function agregar(){ //Funcion que recibe los parametros y los envia al modelo //¿Funcion que agrega un admin?
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $resultado = (new admin())->agregar($usuario, $contrasenia, $id_persona);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un admin
    $id_admin = $_POST['id_admin'];
    $resultado = (new admin())->eliminar($id_admin);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un admin
   $id_admin = $_POST['id_admin'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $id_persona = $_POST['id_persona'];
    $resultado = (new admin())->editar( $id_admin, $usuario, $contrasenia, $id_persona);
    echo json_encode($resultado);
}
?>