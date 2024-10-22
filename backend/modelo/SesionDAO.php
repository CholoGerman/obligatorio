<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
session_start();
class SesionDao{


    function register($correo, $contraseña, $nombre, $apellido, $codigo_postal = null, $calle_dir = null, $num_dir = null) {
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES ('$correo', '$hash', '$nombre', '$apellido')";
        
        
        $connection = connection();
        $respuesta = $connection->query($sqlPersona);
        
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
        }
        
        // Obtener el ID de la persona recién creada
        $idPersona = $connection->insert_id;
    
     
        $sqlCliente = "INSERT INTO cliente(id_persona, codigo_postal, calle_dir, num_dir) VALUES ($idPersona, " . ($codigo_postal ? "'$codigo_postal'" : "NULL") . ", " . ($calle_dir ? "'$calle_dir'" : "NULL") . ", " . ($num_dir ? $num_dir : "NULL") . ");";
        
        $respuestaCliente = $connection->query($sqlCliente);
    
        if (!$respuestaCliente) {
            return new Respuesta(false, "Error al agregar el cliente: " . $connection->error, null);
        }
    
        return new Respuesta(true, "Usuario y cliente registrados correctamente", null);
    }
    
    
    function registerAdmin() {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    // Inserta en la tabla persona
    $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES ('$correo', '$contraseña', '$nombre', '$apellido')";
    $connection = connection();
    $connection->query($sqlPersona);

    // Obtener el ID de la persona recién creada
    $id_persona = $connection->insert_id;

    // Inserta en la tabla admin
    $sqlAdmin = "INSERT INTO admin (id_persona) VALUES ('$id_persona')";
    $connection->query($sqlAdmin);

    // Retornar respuesta
    echo json_encode(["status" => true, "mensaje" => "Administrador registrado correctamente."]);
}

    
    
    
    
    
    
public function login($correo, $contraseña) {
    $sql = "SELECT * FROM persona WHERE correo='$correo'";
    $connection = connection();
    $respuesta = $connection->query($sql);
    $usuario = $respuesta->fetch_assoc();

    // Verifica que el usuario exista y que la contraseña sea correcta
    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        return new Respuesta(true, "Inicio de sesión exitoso", $usuario);
    } else {
        return new Respuesta(false, "Correo o contraseña incorrectos", null);
    }
}



    
    
    
    
        function logOut() {
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
                return new Respuesta(true, "Sesión cerrada correctamente", null);
            }
            return new Respuesta(false, "No hay sesión activa", null);
        }
        
    }
    


