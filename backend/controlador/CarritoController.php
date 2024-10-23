<?php
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
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $departamento = $_POST["departamento"];
  $ciudad = $_POST["ciudad"];
  $calle = $_POST["calle"];
  $numero = $_POST["numero"];
  $telefono = $_POST["telefono"];
  $id_repuesto = $_POST["id_repuesto"];
  $cantidad = $_POST["cantidad"];
  $metodo_pago = $_POST["metodo_pago"];
  $id_envio = $_POST["id_envio"]; 
  $id_cliente = $_POST["id_cliente"];  

  try {
      // Asegúrate de que la función realizarCompra en CarritoDao esté actualizada para aceptar estos parámetros
      $resultado = (new CarritoDao())->realizarCompra($cantidad, $id_repuesto, $metodo_pago, $id_envio, $id_cliente);
      echo json_encode(["success" => true, "data" => $resultado]);
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
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
  }
}

function modificarStock() {
  $id_repuesto = $_POST["id_repuesto"];
  $cantidad = $_POST["cantidad"];

  try {
    $resultado = (new CarritoDao())->modificarStock($id_repuesto, $cantidad);
    echo json_encode(["success" => true, "data" => $resultado]);
  } catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
  }
}



