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
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_FILES["imagen"];

    $respuesta = (new ProductoDao())->agregarProducto($nombre,$precio,$color,$estado, $stock, $descripcion, $imagen);
    
    echo json_encode($respuesta);


}




function eliminarProducto() {
    header('Content-Type: application/json'); // Asegúrate de que la cabecera sea JSON

    // Leer el cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $id_repuesto = $data["id_repuesto"] ; // Usa null si no está definido

    if (empty($id_repuesto)) {
        echo json_encode(new Respuesta(false, "ID del producto no proporcionado", null));
        return;
    }

    $respuesta = (new ProductoDao())->eliminarProducto($id_repuesto);
    echo json_encode($respuesta);
}
