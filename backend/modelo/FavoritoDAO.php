<?php
// Incluye la conexión a la base de datos
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';

class FavoritoDao {
    // Método para agregar un favorito
   

        // Función para agregar un producto a favoritos
        public function agregarFavorito($id_cliente, $id_repuesto) {
            $connection = connection();  // Se obtiene la conexión
    
            // Preparamos el SQL para insertar en la tabla 'favorito'
            $sql = "INSERT INTO favorito (id_cliente, id_repuesto) VALUES (?, ?)";
            
            // Usamos una declaración preparada para evitar inyecciones SQL
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $id_cliente, $id_repuesto);  // 'ii' para dos enteros
    
            // Ejecutamos la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    
        // Función para obtener el id_cliente a partir de id_persona
        public function obtenerIdCliente($id_persona) {
            $connection = connection();  // Se obtiene la conexión
    
            // Preparamos la consulta para obtener el id_cliente
            $sql = "SELECT id_cliente FROM cliente WHERE id_persona = ?";
            
            // Usamos una declaración preparada para evitar inyecciones SQL
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $id_persona);  // 'i' para un solo entero
    
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id_cliente'];  // Retornamos el id_cliente
            } else {
                return null;  // Si no se encuentra, retornamos null
            }
        }
    
   

    // Método para eliminar un favorito
    public function eliminarFavorito($id_cliente, $id_repuesto) {
        // Establecer la conexión a la base de datos
        $connection = connection();

        // Preparamos la consulta SQL para eliminar un favorito
        $sql = "DELETE FROM favorito WHERE id_cliente = ? AND id_repuesto = ?";

        // Usamos la sentencia preparada para evitar inyecciones SQL
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $id_cliente, $id_repuesto);

        // Ejecutamos la consulta
        $resultado = $stmt->execute();

        // Cerramos la sentencia
        $stmt->close();

        // Retornamos si la eliminación fue exitosa
        return $resultado;
    }

    // Método para obtener todos los favoritos de un cliente
    public function obtenerFavoritos($id_cliente) {
        // Establecer la conexión a la base de datos
        $connection = connection();

        // Preparamos la consulta SQL para obtener los favoritos
        $sql = "SELECT f.id_favorito, f.id_cliente, f.id_repuesto, r.nombre_repuesto
                FROM favorito f
                INNER JOIN repuesto r ON f.id_repuesto = r.id_repuesto
                WHERE f.id_cliente = ?";

        // Usamos la sentencia preparada para evitar inyecciones SQL
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id_cliente);

        // Ejecutamos la consulta
        $stmt->execute();

        // Obtenemos el resultado
        $resultado = $stmt->get_result();

        // Creamos un array para almacenar los resultados
        $favoritos = [];
        while ($row = $resultado->fetch_assoc()) {
            $favoritos[] = $row;
        }

        // Cerramos la sentencia
        $stmt->close();

        // Retornamos los favoritos encontrados
        return $favoritos;
    }
}
