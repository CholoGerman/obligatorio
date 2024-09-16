<?php
require_once "../conexion/conexion.php";

class ProductoDao{
    public function obtenerProducto($id_repuesto){
      
        $connection = connection();
        $sql = "SELECT * FROM Repuesto where id_repeusto=$id_repuesto";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }


    public function obtenerCatalogo(){
        $connection = connection();
        $sql = "SELECT * FROM Repuesto";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;

    }


    public function agregarProducto($nombre, $stock, $precio, $color, $estado){
        $sql = "INSERT INTO Repuesto(nombre, stock precio, color, estado) VALUES( 0,  '$nombre', '$stock', '$precio', '$color', '$estado');";
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
