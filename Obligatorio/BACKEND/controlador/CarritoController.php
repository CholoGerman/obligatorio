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

function realizarCompra()
{
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $departamento = $_POST["departamento"];
  $ciudad = $_POST["ciudad"];
  $calle = $_POST["calle"];
  $numero = $_POST["numero"];
  $telefono = $_POST["telefono"];
  /* dudas*/  $id_repuesto = $_POST["id_repuesto"];

  $resultado = (new CarritoDao())->realizarCompra($nombre, $apellido, $departamento, $ciudad, $calle, $numero, $telefono,$id_repuesto);
  echo json_encode($resultado);
}

function agregarDetalle()
{
  $id_pedido = $_GET["id_pedido"];
  $resultado = (new CarritoDao())->agregarDetalle($id_pedido);
  echo json_encode($resultado);
}
function modificarStock()
{
  $id_repuesto = $_POST["id_repuesto"];
  $cantidad = $_POST["cantidad"];
  $resultado = (new CarritoDao())->modificarStock($id_repuesto, $cantidad);
  echo json_encode($resultado);
}
