<?php

require_once "../modelo/ProductoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "obtener":
        obtenerProductos();
        break;
    case "obtenerall":
        obtenerCatalogo();
        break;
    case "agregar":
        agregarProducto();
        break;
        case "eliminar":
            eliminarProducto();
            break;
}


function obtenerProductos() {

}


function obtenerCatalogo() {

}


function agregarProducto() {

    $tipo = $_POST["tipo"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $respuesta = (new ProductoDao())->agregarProducto( $tipo, $precio, $color, $estado );
    echo json_encode($respuesta);


}

function eliminarProducto() {
    $id_repuesto = $_POST["id_repuesto"];

}
