<?php
require_once '../modelo/repuestoDAO.php'; //Indicamos que necesitamos del archivo repuestoDAO.php

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
function obtener(){ //Funcion para mostrar los repuestos
    $resultado = (new repuesto())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo repuesto
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $estado = $_POST['estado'];  
    $id_vehiculo = $_POST['id_vehiculo'];       
    $resultado = (new repuesto())->agregar($tipo, $precio, $color, $estado, $id_vehiculo);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un repuesto
    $id_repuesto = $_POST['id_repuesto'];
    $resultado = (new repuesto())->eliminar($id_repuesto);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un repuesto
    $id_repuesto = $_POST['id_repuesto'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $estado = $_POST['estado'];
    $id_vehiculo = $_POST['id_vehiculo'];
    $resultado = (new repuesto())->editar($id_repuesto, $tipo, $precio, $color, $estado,$id_vehiculo);
    echo json_encode($resultado);
}