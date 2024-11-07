<?php

require_once "../modelo/ProductoDAO.php";

// Obtener la función a ejecutar desde la URL
$funcion = $_GET["funcion"];

switch ($funcion) { // Asignamos una función a cada posible valor de "funcion"
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
    case "modificar":  // Nuevo caso para modificar un producto
        modificarProducto();
        break;

}

// Función para obtener un solo producto
function obtenerProducto() {
    $id_repuesto = $_POST["id_repuesto"];
    $respuesta = (new ProductoDao())->obtenerProducto($id_repuesto);
    echo json_encode($respuesta);
}

// Función para obtener todos los productos
function obtenerCatalogo() {
    $respuesta = (new ProductoDao())->obtenerCatalogo();
    echo json_encode($respuesta);
}

// Función para agregar un nuevo producto
function agregarProducto() {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_FILES["imagen"];

    $respuesta = (new ProductoDao())->agregarProducto($nombre, $precio, $color, $estado, $stock, $descripcion, $imagen);
    
    echo json_encode($respuesta);
}

// Función para eliminar un producto
function eliminarProducto() {
    header('Content-Type: application/json'); // Aseguramos que la respuesta sea en JSON

    // Leer el cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $id_repuesto = $data["id_repuesto"]; // Usamos null si no está definido

    if (empty($id_repuesto)) {
        echo json_encode(new Respuesta(false, "ID del producto no proporcionado", null));
        return;
    }

    $respuesta = (new ProductoDao())->eliminarProducto($id_repuesto);
    echo json_encode($respuesta);
}

// Función para modificar un producto
function modificarProducto() {
    // Obtener los datos del formulario
    $id_repuesto = $_POST["id_repuesto"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];

    // Aquí puedes agregar la lógica para actualizar los datos en la base de datos
    $respuesta = (new ProductoDao())->modificarProducto($id_repuesto, $nombre, $precio, $color, $estado, $stock, $descripcion);
    echo json_encode($respuesta);
}



?>
