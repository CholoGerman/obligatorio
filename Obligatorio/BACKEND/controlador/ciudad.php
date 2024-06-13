<?php 
require_once '../modelo/ciudadDAO.php'; //Indicamos que necesitamos del archivo ciudadDAO.php

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
function obtener(){ //Funcion para mostrar las ciudades
    $resultado = (new ciudad())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar una nueva ciudad
    $nombre_ciudad = $_POST['nombre_ciudad'];
    $id_depto = $_POST['id_depto'];
    $resultado = (new ciudad())->agregar($nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar una ciudad
    $id_ciudad = $_POST['id_ciudad'];
    $resultado = (new ciudad())->eliminar($id_ciudad);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar una ciudad
    $id_ciudad = $_POST['id_ciudad'];
    $nombre_ciudad = $_POST['nombre_ciudad'];
    $id_depto = $_POST['id_depto'];
    $resultado = (new ciudad())->editar($id_ciudad, $nombre_ciudad, $id_depto);
    echo json_encode($resultado);
}
?>