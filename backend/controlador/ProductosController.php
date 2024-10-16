<?php

require_once "../modelo/ProductoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
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


function obtenerProducto() { //Funcion para obtener un producto
    $id_repuesto = $_POST["id_repuesto"];
    $respuesta = (new ProductoDao())->obtenerProducto($id_repuesto);
    echo json_encode($respuesta);
    
}


function obtenerCatalogo() { //Funcion para obtener todos los productos
    $respuesta = (new ProductoDao())->obtenerCatalogo();

   
   echo json_encode($respuesta);
}


function agregarProducto() { //Funcion para publicar un producto
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $imagen = $_FILES["imagen"];
    $descripcion = $_POST["descripcion"];

    $respuesta = (new ProductoDao())->agregarProducto($nombre, $stock, $precio, $color, $estado, $imagen, $descripcion);
    
    echo json_encode($respuesta);


}

function eliminarProducto() { //Funcion para eliminar un producto
    $id_repuesto = $_POST["id_repuesto"];
    $respuesta = (new ProductoDao())->eliminarProducto($id_repuesto);
    echo json_encode($respuesta);

}
