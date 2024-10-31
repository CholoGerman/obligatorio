<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../modelo/CarritoDAO.php";

$funcion = $_GET["funcion"];
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
}


function realizarCompra() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

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
    
    if ($cliente) {
        $id_cliente = $cliente['id_cliente'];
        echo json_encode(["success" => true, "id_cliente" => $id_cliente]);
    } else {
        echo json_encode(["success" => false, "message" => "El cliente no está registrado."]);
    }
    

    $id_cliente = $cliente['id_cliente'];

    // Obtiene los datos de la compra
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $calle = $_POST["calle"];
    $numero = $_POST["numero"];
    $telefono = $_POST["telefono"];
    $metodo_pago = $_POST["metodo_pago"];
    $productos = $_POST["productos"];
    $codigo_postal = $_POST["codigo_postal"];

    
    try {
        $resultadoCompra = (new CarritoDao())->realizarCompra($productos, $metodo_pago, $nombre, $apellido, $calle, $numero, $telefono, $codigo_postal, $id_cliente);
        // Solo envía una respuesta
        echo json_encode(["success" => true, "data" => $resultadoCompra]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}






function agregarDetalle() {
    $id_pedido = $_POST["id_pedido"];
    $id_repuesto = $_POST["id_repuesto"];
    $cantidad = $_POST["cantidad"];

    try {
        $resultado = (new CarritoDao())->agregarDetalle($id_pedido, $id_repuesto, $cantidad);
        echo json_encode(["success" => true, "data" => $resultado]);
    } catch (Exception $e) {
        error_log("Error en agregarDetalle: " . $e->getMessage()); // Registra el error
        echo json_encode(["success" => false, "message" => "Error al agregar detalle."]);
    }
}

function modificarStock() {
    $id_repuesto = $_POST["id_repuesto"];
    $cantidad = $_POST["cantidad"];

    try {
        $resultado = (new CarritoDao())->modificarStock($id_repuesto, $cantidad);
        echo json_encode(["success" => true, "data" => $resultado]);
    } catch (Exception $e) {
        error_log("Error en modificarStock: " . $e->getMessage()); // Registra el error
        echo json_encode(["success" => false, "message" => "Error al modificar stock."]);
    }
}
