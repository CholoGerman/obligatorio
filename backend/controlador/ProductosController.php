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
    // Verificamos que se haya pasado el ID del producto
    if (isset($_POST['id_repuesto'])) {
        $id_repuesto = $_POST['id_repuesto'];

        // Creamos una instancia del modelo
        $productoDao = new ProductoDao();
        
        // Llamamos a la función eliminarProducto del modelo y le pasamos el ID del producto
        $respuesta = $productoDao->eliminarProducto($id_repuesto);

        // Devolvemos la respuesta al cliente
        echo json_encode($respuesta);
    } else {
        echo json_encode(['status' => false, 'mensaje' => 'ID de producto no proporcionado']);
    }
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
