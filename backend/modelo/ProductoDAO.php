<?php
require_once "../conexion/conexion.php";

class ProductoDAO{
    public function obtenerProducto($id_repuesto){ //Funcion para obtener un producto
      
        $connection = connection();
        $sql = "SELECT * FROM Repuesto where id_repeusto=$id_repuesto";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }


    public function obtenerCatalogo(){  //Funcion para obtener todos los productos
        $connection = connection();
        $sql = "SELECT * FROM Repuesto";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;

    }


    public function agregarProducto($nombre, $stock, $precio, $color, $estado , $imagen, $descripcion){  //Funcion para publicar un producto
        $sql = "INSERT INTO Repuesto(nombre, stock, precio, color, estado, imagen, descripcion) VALUES( 0,  '$nombre', '$stock', '$precio', '$color', '$estado' , $imagen ,'$descripcion');";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "agregado correctamente", null);
    }

    public function eliminarProducto($id_repuesto){ //Funcion para eliminar un producto
        $sql = "DELETE FROM Repuesto WHERE id_repuesto = $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "Eliminado correctamente", null);
    }
}
