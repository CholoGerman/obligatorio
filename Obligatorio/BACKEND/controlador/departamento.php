<?php
require_once '../modelo/departamentoDAO.php'; //Indicamos que necesitamos del archivo departamentoDAO.php

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
function obtener(){ //Funcion para mostrar los departamentos
    $resultado = (new departamento())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo departamento
    $nombre_depto_depto = $_POST['nombre_depto_depto'];
    $resultado = (new departamento())->agregar($nombre_depto_depto);
    echo json_encode($resultado);
}
function eliminar()
{ //Funcion para eliminar un departamento
    $id_depto = $_POST['id_depto'];
    $resultado = (new departamento())->eliminar($id_depto);
    echo json_encode($resultado);
}


function editar()
{ //Funcion para editar un departamento
    $id_depto = $_POST['id_depto'];
    $nombre_depto = $_POST['nombre_depto'];
    $resultado = (new departamento())->editar($id_depto, $nombre_depto);
    echo json_encode($resultado);
}