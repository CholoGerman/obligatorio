<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
require_once '../conexion/origin.php';
//Incluye los archivos,ya sea conexion para conectar con la base de datos(crea funcion "connection")
//Incluye la clase respuesta que maneja las respuestas de la apliacion,indicando si la operacion fue exitosa.
//Incluye origin que seria la ruta de la imagen.

//Crea la clase DAO Producto donde se define todo los metodos para interactuar con la base de datos
class ProductoDao
{
 
    //Define el motodo,en este caso se recibe como parametro id_respuesto
   public function obtenerProducto($id_repuesto)
    {
        $connection = connection(); //Obtiene la conexion con la base de datos.
        // Consulta SQL directa para obtener el producto
        $sql = "SELECT r.*, i.extension FROM repuesto r 
                INNER JOIN imagen i ON r.id_imagen = i.id_imagen 
                WHERE r.id_repuesto = $id_repuesto"; 

        //Guarda en una variable:Contruye la consulta sql para obtener los datos y la extencion de la imagen

        $respuesta = $connection->query($sql); //Ejecuta la consulta SQL y almacena el resultado en una variable
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC); 
        //Obtiene los resultados de la consulta como arrray asosiativa y lo guarda en una variable  
        return $productos;
        //Devuelve el array productos al controlador que llamo al metodo.
    }

    public function obtenerCatalogo()
    {
        $connection = connection();
        // Consulta SQL directa para obtener el catálogo de productos
        $sql = "SELECT r.*, CONCAT('../IMG/', r.id_repuesto, '.', i.extension) AS imagen 
                FROM repuesto r
                INNER JOIN imagen i ON r.id_imagen = i.id_imagen";

        $respuesta = $connection->query($sql);
        $productos = [];
        $origen = getOrigin();

        while ($result = $respuesta->fetch_assoc()) { 
            //while que recorre todos los resultados obtenidos
            $imagen = $result['imagen']; //Guarda la ruta de la imagen

            //Contruye una array asosiativa con los datos del producto e imagen 
            //y los agrega a la variable producto
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

    public function agregarProducto($nombre, $precio, $color, $estado, $stock, $descripcion, $imagen)
    {
        // Establecemos la conexión a la base de datos
        $connection = connection();

        // Validación de la imagen
        if ($imagen["error"] != 0) {
            return new Respuesta(false, "Error al subir la imagen.", null);
        }

        $nombreImagen = $imagen["name"];
        $rutaTemporal = $imagen["tmp_name"];
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);

        //obtiene el nombre de la imagen,la ruta temporal y donde se encuentra y 
        //la extension de la imagen

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




    public function eliminarProducto($id_repuesto)
    {
        $connection = connection();


        // Primero, eliminamos los registros en la tabla 'favorito' que dependen del producto
        $sqlFavorito = "DELETE FROM favorito WHERE id_repuesto = $id_repuesto";

        if ($connection->query($sqlFavorito) === FALSE) {
            return ['status' => false, 'mensaje' => 'Error al eliminar los favoritos asociados al producto: ' . $connection->error];
        }

        // Luego, eliminamos los detalles asociados en la tabla 'detalle_repuesto'
        $sqlDetalle = "DELETE FROM detalle_repuesto WHERE ID_Repuesto = $id_repuesto";

        if ($connection->query($sqlDetalle) === FALSE) {
            return ['status' => false, 'mensaje' => 'Error al eliminar los detalles asociados al producto: ' . $connection->error];
        }

        // Finalmente, eliminamos el producto de la tabla 'repuesto'
        $sqlRepuesto = "DELETE FROM Repuesto WHERE id_repuesto = $id_repuesto";

        if ($connection->query($sqlRepuesto) === TRUE) {
            return ['status' => true, 'mensaje' => 'Producto eliminado correctamente'];
        } else {
            return ['status' => false, 'mensaje' => 'Error al eliminar el producto: ' . $connection->error];
        }
    }



    public function modificarProducto($id_repuesto, $nombre, $precio, $color, $estado, $stock, $descripcion)
    {
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

    public function obtenerEstadisticas()
    {
        $connection = connection();

        // Consulta SQL para obtener las estadísticas de ventas y ganancias
        $sql = "
        SELECT r.id_repuesto, 
       r.nombre, 
       SUM(d.cantidad) AS ventas_totales,
       SUM(d.cantidad * d.precio) AS ganancias_totales,
       i.extension AS imagen_extension
    FROM detalle d
    JOIN detalle_repuesto dr ON d.id_detalle = dr.ID_Detalle
    JOIN repuesto r ON dr.ID_Repuesto = r.id_repuesto
    JOIN imagen i ON r.id_imagen = i.id_imagen
    GROUP BY r.id_repuesto;

        ";

        // Ejecutar la consulta
        $respuesta = $connection->query($sql);

        // Verificar si la consulta fue exitosa
        if (!$respuesta) {
            // En caso de error, retornamos un objeto de respuesta con el error
            return new Respuesta(false, "Error en la consulta: " . $connection->error, null);
        }

        // Obtener todos los resultados de la consulta en un solo paso
        $productos = $respuesta->fetch_all(MYSQLI_ASSOC);

        // Devolver los resultados en formato JSON
        return new Respuesta(true, "Estadísticas obtenidas correctamente", $productos);
    }
}
