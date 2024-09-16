<?php
require_once "../conexion/conexion.php";

class CarritoDao{

function realizarCompra($fecha, $metodo_pago, $id_cliente){
    $sql = "INSERT INTO pedido( fecha, metodo_pago, id_cliente) VALUES (0, $fecha,$metodo_pago,$id_cliente)"; 
    $connection = connection();
    $respuesta = $connection->query($sql);
    if($respuesta){
        $detalle=$this->agregarDetalle($cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido);
        if ($detalle){
            $this->modificarStock($id_repuesto, $id_vehiculo, $estado, $color, $precio, $tipo);
        }
    }
    return new Respuesta(true, "Agregado correctamente", null);
}

function agregarDetalle($cantidad, $precio_unitario, $precio_total, $id_repuesto, $id_pedido){
    $sql = "INSERT INTO detalle_pedido ( cantidad, precio_unitario, precio_total, id_repuesto, id_pedido) VALUES (0 ,$cantidad, $precio_unitario,$precio_total,$id_repuesto,$id_pedido)"; // borrar la publicacion?
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
}

function modificarStock($id_repuesto, $id_vehiculo, $estado, $color, $precio, $tipo){
    $sql = "UPDATE repuesto SET tipo='$tipo',precio='$precio',color='$color',estado='$estado',id_vehiculo='$id_vehiculo' WHERE id_repuesto = $id_repuesto"; 
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
}


}