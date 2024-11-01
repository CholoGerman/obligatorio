<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../modelo/CarritoDAO.php";

$funcion = $_GET["funcion"] ?? null; // Evita notices si 'funcion' no está definido
switch ($funcion) {
    case "comprar":
        realizarCompra();
        break;
    case "factura":
        agregarDetalle();
        break;
    case "stock":
        modificarStock();
        break;
    default:
        echo json_encode(["success" => false, "message" => "Función no válida."]);
        http_response_code(400);
        break;
}

function realizarCompra() {
    if (!isset($_SESSION["session"]) || !isset($_SESSION["session"]["id_persona"])) {
        echo json_encode(["success" => false, "message" => "No se ha iniciado sesión."]);
        return;
    }

    // Obtener id_persona
    $id_persona = $_SESSION['session']['id_persona'];

    // Consultar el id_cliente correspondiente al id_persona
    $sql = "SELECT id_cliente FROM cliente WHERE id_persona = '$id_persona'";
    $connection = connection();
    $resultado = $connection->query($sql);
    $cliente = $resultado->fetch_assoc();
    
    if (!$cliente) {
        echo json_encode(["success" => false, "message" => "El cliente no está registrado."]);
        return; // Salir si el cliente no existe
    }

    $id_cliente = $cliente['id_cliente'];

    // Obtiene los datos de la compra
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $calle = $_POST["calle"];
    $numero = $_POST["numero"];
    $telefono = $_POST["telefono"];
    $metodo_pago = $_POST["metodo_pago"];
    $productos = json_decode($_POST["productos"], true); // Decodificar productos de JSON
    $codigo_postal = $_POST["codigo_postal"];

    // Verificar que todos los campos necesarios estén presentes
    if (empty($nombre) || empty($apellido) || empty($calle) || empty($numero) || empty($telefono) || empty($metodo_pago) || empty($productos) || empty($codigo_postal)) {
        echo json_encode(["success" => false, "message" => "Faltan datos en la compra."]);
        return;
    }

    try {
        $resultadoCompra = (new CarritoDao())->realizarCompra($productos, $metodo_pago, $nombre, $apellido, $calle, $numero, $telefono, $codigo_postal, $id_cliente, $id_persona);
        echo json_encode(["success" => true, "id_pedido" => $resultadoCompra]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}



function agregarDetalle() {
    $id_pedido = $_POST["id_pedido"] ?? null;
    $id_repuesto = $_POST["id_repuesto"] ?? null;
    $cantidad = $_POST["cantidad"] ?? null;

    if (is_null($id_pedido) || is_null($id_repuesto) || is_null($cantidad)) {
        echo json_encode(["success" => false, "message" => "Faltan datos para agregar el detalle."]);
        http_response_code(400);
        return;
    }

    try {
        $resultado = (new CarritoDao())->agregarDetalle($id_pedido, $id_repuesto, $cantidad);
        echo json_encode(["success" => true, "data" => $resultado]);
    } catch (Exception $e) {
        error_log("Error en agregarDetalle: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Error al agregar detalle."]);
        http_response_code(500);
    }
}

function modificarStock() {
    $id_repuesto = $_POST["id_repuesto"] ?? null;
    $cantidad = $_POST["cantidad"] ?? null;

    if (is_null($id_repuesto) || is_null($cantidad)) {
        echo json_encode(["success" => false, "message" => "Faltan datos para modificar el stock."]);
        http_response_code(400);
        return;
    }

    try {
        $resultado = (new CarritoDao())->modificarStock($id_repuesto, $cantidad);
        echo json_encode(["success" => true, "data" => $resultado]);
    } catch (Exception $e) {
        error_log("Error en modificarStock: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Error al modificar stock."]);
        http_response_code(500);
    }
}