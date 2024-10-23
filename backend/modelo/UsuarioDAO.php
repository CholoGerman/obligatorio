<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';

class UsuarioDao{
 
function obtenerUsuarios(){ //Funcion para mostrar los clientes
    $connection = connection();
    $sql = "SELECT * FROM persona;";
    $respuesta = $connection->query($sql);
    $Usuario = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $Usuario;

}

public function obtenerClientePorId($id_cliente) {
    $sql = "SELECT p.nombre, p.apellido 
            FROM cliente c 
            JOIN persona p ON c.id_persona = p.id_persona 
            WHERE c.id_cliente = ?";
    
    $connection = connection();
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $id_cliente);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    }
    return null; 
}




function eliminarUsuario($correo){ //Funcion para eliminar un cliente
    $sql = "DELETE FROM persona WHERE correo = '$correo';";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
    return new Respuesta(true,"Eliminado correctamente",null);
}

}