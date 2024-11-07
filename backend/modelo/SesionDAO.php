<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class SesionDao {

    // Método para registrar un nuevo usuario
    function register($correo, $contraseña, $nombre, $apellido, $codigo_postal = null, $calle_dir = null, $num_dir = null) {
        $connection = connection();

        // Validar si el correo ya está registrado
        $sqlCheck = "SELECT * FROM persona WHERE correo = ?";
        $stmt = $connection->prepare($sqlCheck);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultadoCheck = $stmt->get_result();
        
        if ($resultadoCheck && $resultadoCheck->num_rows > 0) {
            return new Respuesta(false, "El correo ya está registrado.", null);
        }
        
        // Hashea la contraseña
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
        
        // Consulta SQL para insertar la nueva persona
        $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sqlPersona);
        $stmt->bind_param("ssss", $correo, $hash, $nombre, $apellido);
        
        // Ejecuta la consulta
        if (!$stmt->execute()) {
            error_log("Error al agregar la persona: " . $connection->error);
            return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
        }
        
        
        // Obtener el ID de la persona recién creada
        $idPersona = $connection->insert_id;
    
        // Consulta SQL para insertar el cliente asociado a la persona
        $sqlCliente = "INSERT INTO cliente (id_persona, codigo_postal, calle_dir, num_dir) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sqlCliente);
        $stmt->bind_param("isss", $idPersona, $codigo_postal, $calle_dir, $num_dir);
        
        // Ejecuta la consulta para el cliente
        if (!$stmt->execute()) {
            return new Respuesta(false, "Error al agregar el cliente: " . $connection->error, null);
        }
    
        // Retorna una respuesta exitosa
        return new Respuesta(true, "Usuario y cliente registrados correctamente", null);
    }
    
    // Método para registrar un administrador
    function registerAdmin($correo, $contraseña, $nombre, $apellido) {
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $connection = connection();
    
        // Inserta en la tabla persona
        $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sqlPersona);
        $stmt->bind_param("ssss", $correo, $hash, $nombre, $apellido);
    
        if (!$stmt->execute()) {
            return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
        }
    
        $id_persona = $connection->insert_id; // Obtiene el ID de la persona recién agregada
    
        // Inserta en la tabla admin
        $sqlAdmin = "INSERT INTO admin (id_persona) VALUES (?)";
        $stmt = $connection->prepare($sqlAdmin);
        $stmt->bind_param("i", $id_persona);
    
        if (!$stmt->execute()) {
            return new Respuesta(false, "Error al agregar el administrador: " . $connection->error, null);
        }
    
        return new Respuesta(true, "Administrador registrado correctamente", null);
    }
    public function getIdCliente($id_persona) {
        $sql = "SELECT id_cliente FROM cliente WHERE id_persona = $id_persona";
        $connection = connection();
        $resultado = $connection->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_assoc()['id_cliente'];
        }
        return null; // O manejar el caso donde no se encuentre el cliente
    }
    
    
    // Método para iniciar sesión
    public function login($correo, $contraseña) {
        $connection = connection();
        $sql = "SELECT * FROM persona WHERE correo=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $respuesta = $stmt->get_result();
    
        if ($respuesta) {
            $usuario = $respuesta->fetch_assoc();
            if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
                // Iniciar sesión y guardar datos del usuario
                $_SESSION["session"] = [
                    "id_persona" => $usuario['id_persona'],
                    "correo" => $usuario['correo'],
                    "nombre" => $usuario['nombre'],
                    "apellido" => $usuario['apellido']
                ];
                
    
                return new Respuesta(true, "Inicio de sesión exitoso", $usuario);
            } else {
                return new Respuesta(false, "Correo o contraseña incorrectos", null);
            }
        } else {
            error_log("Error en consulta de login: " . $connection->error);
            return new Respuesta(false, "Error en la consulta", null);
        }
    }
    
    // Método para cerrar sesión
    function logOut() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            return new Respuesta(true, "Sesión cerrada correctamente", null);
        }
        return new Respuesta(false, "No hay sesión activa", null);
    }
}
