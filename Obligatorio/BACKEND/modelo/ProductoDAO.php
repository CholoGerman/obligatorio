<?php
require_once "../conexion/conexion.php";

class ProductoDao{
    public function obtenerProductos(){
        // codigo a sql
        $connection = connection();
        $sql = "SELECT * FROM Productos";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }


    public function obtenerCatalogo(){
        // codigo a sql

    }


    public function agregarProducto($tipo, $precio, $color, $estado){
        $sql = "INSERT INTO Repuesto(tipo, precio, color, estado) VALUES( '$tipo', '$precio', '$color', '$estado');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "agregado correctamente", null);
    }

    public function eliminarProducto($id_repuesto){
        $sql = "DELETE FROM Repuesto WHERE id_repuesto = $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "Eliminado correctamente", null);
    }
}
