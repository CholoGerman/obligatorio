<?php
require_once '../modelo/pedidoDAO.php'; //Indicamos que necesitamos del archivo pedidoDAO.php

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
function obtener(){ //Funcion para mostrar los pedidos
    $resultado = (new pedido())->obtener();
    echo json_encode($resultado);
}
function agregar(){ //Funcion para agregar un nuevo pedido

    $fecha = $_POST['fecha'];
    $metodo_pago = $_POST['metodo_pago'];
    $ID_cliente = $_POST['ID_cliente'];
    $resultado = (new pedido())->agregar($fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
function eliminar(){ //Funcion para eliminar un pedido
    $id_pedido = $_POST['id_pedido'];
    $resultado = (new pedido())->eliminar($id_pedido);
    echo json_encode($resultado);
}


function editar(){ //Funcion para editar un pedido
    $id_pedido = $_POST['id_pedido'];
    $fecha = $_POST['fecha'];
    $metodo_pago = $_POST['cedula'];
    $ID_cliente = $_POST['ID_cliente'];
    $resultado = (new pedido())->editar($id_pedido, $fecha, $metodo_pago, $ID_cliente);
    echo json_encode($resultado);
}
