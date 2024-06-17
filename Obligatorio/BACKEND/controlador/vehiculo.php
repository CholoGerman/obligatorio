<?php
require_once '../modelo/vehiculoDAO.php'; //Indicamos que necesitamos del archivo vehiculoDAO.php

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
function obtener(){ //Funcion para mostrar los vehiculos
    $resultado = (new vehiculo())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo vehiculo
    $marca = $_GET['marca'];
    $modelo = $_GET['modelo'];
    $anio = $_GET['anio'];       
    $resultado = (new vehiculo())->agregar($marca, $modelo, $anio);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un vehiculo
    $id_vehiculo = $_GET['id_vehiculo'];
    $resultado = (new vehiculo())->eliminar($id_vehiculo);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un vehiculo
    $id_vehiculo = $_GET['id_vehiculo'];
    $marca = $_GET['marca'];
    $modelo = $_GET['modelo'];
    $anio = $_GET['anio'];
    $resultado = (new vehiculo())->editar($id_vehiculo, $marca, $modelo, $anio);
    echo json_encode($resultado);
}