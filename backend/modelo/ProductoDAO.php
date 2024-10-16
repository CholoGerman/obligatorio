<?php
require_once "../conexion/conexion.php";

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


    public function agregarProduct2($nombre, $stock, $precio, $color, $estado , $imagen, $descripcion){  //Funcion para publicar un producto
        $connection = connection(); 
        $sql1 = "INSERT INTO Repuesto(nombre, stock, precio, color, estado, imagen, descripcion) VALUES( '$nombre', '$stock', '$precio', '$color', '$estado' , $imagen ,'$descripcion');";
        $respuesta = $connection->query($sql1);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;


        $rutaTemporal = $imagen["tmp_name"];
        $nombreImagen = $imagen["name"];
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $sql2 = "INSERT INTO imagen (0, extension) VALUES('$extension');";
        $connection = connection();
        $respuesta = $connection->query($sql2);
        $id = $connection->insert_id;
        move_uploaded_file($rutaTemporal, "../IMG/$id.$extension");
        return $respuesta;
        return new Respuesta(true, "agregado correctamente", null);


    }

    public function agregarProducto($nombre, $stock, $precio, $color, $estado, $imagen, $descripcion) {  
        // Conectar a la base de datos
        $connection = connection();
    
        // Extraer el nombre del archivo de imagen
        $nombreImagen = $imagen["name"]; // Aquí obtienes el nombre del archivo
        $rutaTemporal = $imagen["tmp_name"]; // Aquí obtienes la ruta temporal
    
        // Preparar la consulta para insertar en la tabla Repuesto
        $sqlRepuesto = "INSERT INTO Repuesto(nombre, stock, precio, color, estado, img_repuesto, descripcion) VALUES('$nombre', '$stock', '$precio', '$color', '$estado', '$nombreImagen', '$descripcion');";
        
        // Ejecutar la consulta
        $respuesta = $connection->query($sqlRepuesto);
    
        // Verificar si la inserción fue exitosa
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el producto: " . $connection->error, null);
        }
    
        // Obtener el ID del producto agregado
        $id = $connection->insert_id;
    
        // Procesar la imagen
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        
        // Insertar en la tabla de imagen
        $sqlImagen = "INSERT INTO imagen (nombre, extension) VALUES('$nombreImagen', '$extension');";
        $respuesta2 = $connection->query($sqlImagen);
    
        if (!$respuesta2) {
            return new Respuesta(false, "Error al agregar la imagen: " . $connection->error, null);
        }
    
        // Mover el archivo a la carpeta correspondiente
        move_uploaded_file($rutaTemporal, "../IMG/$id.$extension");
    
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
