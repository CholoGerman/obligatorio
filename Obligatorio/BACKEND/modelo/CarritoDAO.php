<?php
require_once "../conexion/conexion.php";

class CarritoDao{

function realizarCompra(){
    $sql = ""; // agregar un pedido?
    $sql = ""; // borrar la publicacion?
    $sql = ""; // actualizar stock?
    $sql = ""; // crear la factura?
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    return new Respuesta(true, "Agregado correctamente", null);
}


}