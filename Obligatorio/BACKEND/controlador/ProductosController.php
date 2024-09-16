<?php

require_once "../modelo/ProductoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "obtener":
        obtenerProducto();
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


function obtenerProducto() {
    $id_repuesto = $_POST["id_repuesto"];
    $respuesta = (new ProductoDao())->obtenerProducto($id_repuesto);
    echo json_encode($respuesta);
}


function obtenerCatalogo() {
   
    $respuesta = (new ProductoDao())->obtenerCatalogo();
    echo json_encode($respuesta);
}


function agregarProducto() {
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $respuesta = (new ProductoDao())->agregarProducto($nombre, $stock, $precio, $color, $estado );
    echo json_encode($respuesta);


}

function eliminarProducto() {
    $id_repuesto = $_POST["id_repuesto"];
    $respuesta = (new ProductoDao())->eliminarProducto($id_repuesto);
    echo json_encode($respuesta);

}
