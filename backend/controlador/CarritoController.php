<?php
// Inicia la sesión si no ha sido iniciada previamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Requiere el modelo de CarritoDAO
require_once "../modelo/CarritoDAO.php";

// Obtiene la función a ejecutar desde los parámetros GET, o null si no está definida
$funcion = $_GET["funcion"] ?? null; 

// determinar qué función ejecutar
switch ($funcion) {
    case "comprar":
        realizarCompra(); // Llama a la función para realizar la compra
        break;
    case "stock":
        modificarStock(); // Llama a la función para modificar el stock
        break;
    default:
        echo json_encode(["success" => false, "message" => "Función no válida."]);  // Si la función no es válida, devuelve un mensaje de error
        break;
}

// Función para realizar la compra
function realizarCompra() {
    // Verifica que el usuario haya iniciado sesión
    if (!isset($_SESSION["session"]) || !isset($_SESSION["session"]["id_persona"])) {
        echo json_encode(["success" => false, "message" => "No se ha iniciado sesión."]);
        return; 
    }

    // Obtiene el id_persona desde la sesión
    $id_persona = $_SESSION['session']['id_persona'];

    // Consulta el id_cliente correspondiente al id_persona
    $sql = "SELECT id_cliente FROM cliente WHERE id_persona = '$id_persona'";
    $connection = connection();
    $resultado = $connection->query($sql);

    // Verifica si se obtuvo un cliente válido
    if ($resultado->num_rows == 0) {
        error_log("Cliente no encontrado para id_persona: $id_persona");
        echo json_encode(["success" => false, "message" => "Cliente no encontrado."]);
        return;  // Termina la ejecución si no se encuentra un cliente
    }

    // Almacena el id_cliente obtenido
    $cliente = $resultado->fetch_assoc();
    $id_cliente = $cliente['id_cliente'];

    // Obtiene los datos de la compra del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $calle = $_POST["calle"];
    $numero = $_POST["numero"];
    $telefono = $_POST["telefono"];
    $metodo_pago = $_POST["metodo_pago"];
    $productos = json_decode($_POST["productos"], true); // Decodifica los productos de JSON
    error_log(print_r($productos, true));
    $codigo_postal = $_POST["codigo_postal"];

    // Verifica que los productos sean válidos
    if (!is_array($productos) || empty($productos)) {
        error_log("Productos no son válidos o están vacíos.");
        echo json_encode(["success" => false, "message" => "Productos no válidos o vacíos."]);
        return;  // Termina la ejecución si no hay productos válidos
    }

    // Intenta realizar la compra
    try {
        $resultadoCompra = (new CarritoDao())->realizarCompra($productos, $metodo_pago, $nombre, $apellido, $calle, $numero, $telefono, $codigo_postal, $id_cliente, $id_persona);
        echo json_encode(["success" => true, "id_pedido" => $resultadoCompra]); // Devuelve el resultado exitoso
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]); // Captura errores y devuelve mensaje
    }
}



// Función para modificar el stock
function modificarStock() {
    $id_repuesto = $_POST["id_repuesto"] ?? null; // Obtiene el id_repuesto
    $cantidad = $_POST["cantidad"] ?? null; // Obtiene la cantidad

    // Verifica que los datos necesarios estén presentes
    if (is_null($id_repuesto) || is_null($cantidad)) {
        echo json_encode(["success" => false, "message" => "Faltan datos para modificar el stock."]);
        http_response_code(400); // Establece el código de respuesta HTTP a 400
        return; // Sale si faltan datos
    }

    // Intenta modificar el stock
    try {
        $resultado = (new CarritoDao())->modificarStock($id_repuesto, $cantidad);
        echo json_encode(["success" => true, "data" => $resultado]); // Devuelve el resultado exitoso
    } catch (Exception $e) {
        error_log("Error en modificarStock: " . $e->getMessage()); // Registra el error
        echo json_encode(["success" => false, "message" => "Error al modificar stock."]); // Devuelve mensaje de error
        http_response_code(500); // Establece el código de respuesta HTTP a 500
    }
}
