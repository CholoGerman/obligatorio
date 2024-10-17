<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';

class ProductoDao{
    public function obtenerProducto($id_repuesto){ //Funcion para obtener un producto
        $connection = connection();
        $sql = "SELECT * FROM repuesto WHERE id_repuesto = $id_repuesto";
        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }


    public function obtenerCatalogo(){  //Funcion para obtener todos los productos 
        
        $connection = connection();
        $sql = "SELECT * FROM repuesto";
        $respuesta = $connection->query($sql);
        
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);

      
        return $productos;

    }



    public function agregarProducto($nombre, $precio, $color, $estado, $stock, $descripcion, $imagen) {  
        $connection = connection();
        
        // Extraer el nombre del archivo de imagen
        $nombreImagen = $imagen["name"];
        $rutaTemporal = $imagen["tmp_name"];
    
        // Insertar en la tabla Repuesto
        $sqlRepuesto = "INSERT INTO Repuesto(nombre, precio, color, estado, stock, descripcion) VALUES('$nombre', '$precio', '$color', '$estado', '$stock', '$descripcion');";
        $respuesta = $connection->query($sqlRepuesto);
        
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el producto: " . $connection->error, null);
        }
    
        // Obtener el ID del producto agregado
        $idRepuesto = $connection->insert_id;
    
        // Procesar la imagen
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $sqlImagen = "INSERT INTO imagen (extension) VALUES('$extension');";
        $respuesta2 = $connection->query($sqlImagen);
    
        if (!$respuesta2) {
            return new Respuesta(false, "Error al agregar la imagen: " . $connection->error, null);
        }
    
        // Obtener el ID de la imagen insertada
        $idImagen = $connection->insert_id;
    
        // Actualizar la tabla Repuesto con el id_imagen
        $sqlActualizarRepuesto = "UPDATE Repuesto SET id_imagen = $idImagen WHERE id_repuesto = $idRepuesto;";
        $connection->query($sqlActualizarRepuesto);
    
        // Mover el archivo a la carpeta correspondiente
        move_uploaded_file($rutaTemporal, "../IMG/$idRepuesto.$extension");
    
        return new Respuesta(true, "Agregado correctamente", null);
    }
    
    
    

    public function eliminarProducto($id_repuesto){ //Funcion para eliminar un producto
        $sql = "DELETE FROM Repuesto WHERE id_repuesto = $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "Eliminado correctamente", null);
    }
}
