<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
require_once '../conexion/origin.php';

class ProductoDao{
    public function obtenerProducto($id_repuesto) { 
        $connection = connection();
        // Consulta SQL directa para obtener el producto
        $sql = "SELECT r.*, i.extension FROM repuesto r 
                INNER JOIN imagen i ON r.id_imagen = i.id_imagen 
                WHERE r.id_repuesto = $id_repuesto";  // Inyección de datos directamente en la consulta

        $respuesta = $connection->query($sql);
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }

    public function obtenerCatalogo() {
        $connection = connection();
        // Consulta SQL directa para obtener el catálogo de productos
        $sql = "SELECT r.*, CONCAT('../IMG/', r.id_repuesto, '.', i.extension) AS imagen 
                FROM repuesto r
                INNER JOIN imagen i ON r.id_imagen = i.id_imagen"; 
        
        $respuesta = $connection->query($sql);
        $productos = [];
        $origen = getOrigin();
      
        while ($result = $respuesta->fetch_assoc()) {
            $imagen = $result['imagen'];
            $productos[] = [
                'id_repuesto' => $result['id_repuesto'],
                'nombre' => $result['nombre'],
                'precio' => $result['precio'],
                'color' => $result['color'],
                'estado' => $result['estado'],
                'stock' => $result['stock'],
                'descripcion' => $result['descripcion'],
                'imagen' => "$origen/backend/IMG/$imagen"
            ];
        }
    
        return $productos;
    }

    public function agregarProducto($nombre, $precio, $color, $estado, $stock, $descripcion, $imagen) {
        // Establecemos la conexión a la base de datos
        $connection = connection();

        // Validación de la imagen
        if ($imagen["error"] != 0) {
            return new Respuesta(false, "Error al subir la imagen.", null);
        }

        $nombreImagen = $imagen["name"];
        $rutaTemporal = $imagen["tmp_name"];
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);

        // Insertamos el producto en la tabla Repuesto
        $sqlRepuesto = "INSERT INTO Repuesto(nombre, precio, color, estado, stock, descripcion) 
                        VALUES('$nombre', '$precio', '$color', '$estado', '$stock', '$descripcion')";
        
        $respuesta = $connection->query($sqlRepuesto);
        
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el producto: " . $connection->error, null);
        }

        // Obtenemos el ID del producto recién insertado
        $idRepuesto = $connection->insert_id;

        // Insertamos la imagen en la tabla imagen
        $sqlImagen = "INSERT INTO imagen (extension) VALUES('$extension')";
        $respuesta2 = $connection->query($sqlImagen);
        
        if (!$respuesta2) {
            return new Respuesta(false, "Error al agregar la imagen: " . $connection->error, null);
        }

        // Obtenemos el ID de la imagen insertada
        $idImagen = $connection->insert_id;

        // Actualizamos el producto con el ID de la imagen
        $sqlActualizarRepuesto = "UPDATE Repuesto SET id_imagen = $idImagen WHERE id_repuesto = $idRepuesto";
        $connection->query($sqlActualizarRepuesto);

        // Movemos la imagen al directorio correspondiente
        $rutaDestino = "../IMG/$idRepuesto.$extension";
        if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
            return new Respuesta(false, "Error al mover la imagen.", null);
        }

        // Retornamos la respuesta exitosa
        return new Respuesta(true, "Producto agregado correctamente", ['id_repuesto' => $idRepuesto]);
    }
    
    
    

    public function eliminarProducto($id_repuesto) { // Función para eliminar un producto
        $sql = "DELETE FROM Repuesto WHERE id_repuesto = $id_repuesto;";
        $connection = connection();
        $respuesta = $connection->query($sql);
    
        if ($respuesta) {
            return new Respuesta(true, "Eliminado correctamente", null);
        } else {
            return new Respuesta(false, "Error al eliminar el producto", null);
        }
    }
    


    public function modificarProducto($id_repuesto, $nombre, $precio, $color, $estado, $stock, $descripcion) {
        $connection = connection();
    
        // Actualizar los datos en la tabla Repuesto
        $sql = "UPDATE Repuesto SET nombre = '$nombre', precio = '$precio', color = '$color', estado = '$estado', stock = '$stock', descripcion = '$descripcion' WHERE id_repuesto = $id_repuesto";
        $respuesta = $connection->query($sql);
    
        if ($respuesta) {
            return new Respuesta(true, "Producto actualizado correctamente", null);
        } else {
            return new Respuesta(false, "Error al actualizar el producto", null);
        }
    }
}    