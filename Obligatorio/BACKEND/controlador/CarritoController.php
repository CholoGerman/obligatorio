<?php
require_once "../modelo/CarritoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "comprar":
        realizarCompra();
        break;
}

function realizarCompra(){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $departamento = $_POST["departamento"];
    $ciudad = $_POST["ciudad"];
    $calle = $_POST["calle"];
    $numero = $_POST["numero"];
    $telefono = $_POST["telefono"];
  //dudas  $id_repuesto = $_POST["id_repuesto"];

    $resultado = (new CarritoDao())->realizarCompra($nombre, $apellido, $departamento, $ciudad, $calle, $numero, $telefono);
    echo json_encode($resultado);


}
