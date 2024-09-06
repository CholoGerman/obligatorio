<?php
require_once "../modelo/CarritoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "comprar":
        realizarCompra();
        break;
}

function realizarCompra(){
  


}
