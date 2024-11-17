<?php

require_once "../modelo/ProductoDAO.php";
//Contiene funciones de accceso a la base de datos para interactuar 
//Con la informacion del producto

//Se obtiene el valor de la funcion desde la URL
//usando GET.
$funcion = $_GET["funcion"];

switch ($funcion) {
     //El switch evualua el valor de la funcion
    //para ejecutar la operacin solicitada

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
    case "obtenerEstadisticas":
        obtenerEstadisticas();
        break;
}

// Función para obtener un solo producto
function obtenerProducto()
{
    $id_repuesto = $_POST["id_repuesto"];
    //obtiene el id_respuesto del producto
    //por el usuario mediante POST

    $respuesta = (new ProductoDao())->obtenerProducto($id_repuesto);
    //Crea una instancia de ProductoDAO y llama al metodo 
    //obtenerProducto pasando el id_respuesto
    echo json_encode($respuesta);
    //Convierta la respuesta en formato JSON y la
    //envia al Cliente
}

// Función para obtener todos los productos
function obtenerCatalogo()
{
    $respuesta = (new ProductoDao())->obtenerCatalogo();
    echo json_encode($respuesta);
}

// Función para agregar un nuevo producto
function agregarProducto()
{
    //Obtiene los datos usando POST
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $color = $_POST["color"];
    $estado = $_POST["estado"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_FILES["imagen"];

    //Pasa los datos obtenidos llamando al metodo agregarProducto
    //del DAO producto
    $respuesta = (new ProductoDao())->agregarProducto($nombre, $precio, $color, $estado, $stock, $descripcion, $imagen);

    echo json_encode($respuesta);
}

// Función para eliminar un producto
function eliminarProducto()
{
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
function modificarProducto()
{
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


function obtenerEstadisticas() {
    $productoDao = new ProductoDao();
    $respuesta = $productoDao->obtenerEstadisticas();
    
    // Comprobamos si la respuesta tiene datos o si hay algún error
    if (!$respuesta->status) {
        // Si hubo un error, devolvemos el mensaje de error
        echo json_encode(["error" => $respuesta->mensaje]);
    } else {
        // Si todo fue correcto, devolvemos los datos
        echo json_encode($respuesta->datos);
    }
}

