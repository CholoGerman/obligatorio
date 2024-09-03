<?php
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "obtener":
        obtenerPedido();
        break;
    case "obtenerall":
        obtenerPedidos();
        break;
    case "estado":
        cambiarEstadoPedido();
        break;
}
function obtenerPedido(){


}

function obtenerPedidos(){


}

function cambiarEstadoPedido(){

    
}
