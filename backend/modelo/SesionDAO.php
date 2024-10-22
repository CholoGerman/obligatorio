<?php
// Incluye el archivo de conexión a la base de datos
require_once "../conexion/conexion.php";
// Incluye el modelo Respuesta (puede haber un error tipográfico en "Repuesta")
require_once '../modelo/Repuesta.php';
// Inicia la sesión
session_start();

class SesionDao {

    // Método para registrar un nuevo usuario
    function register($correo, $contraseña, $nombre, $apellido, $codigo_postal = null, $calle_dir = null, $num_dir = null) {
        // Hashea la contraseña antes de almacenarla
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
        // Consulta SQL para insertar la nueva persona
        $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES ('$correo', '$hash', '$nombre', '$apellido')";
        
        // Obtiene la conexión a la base de datos
        $connection = connection();
        // Ejecuta la consulta
        $respuesta = $connection->query($sqlPersona);
        
        // Verifica si hubo un error en la consulta
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
        }
        
        // Obtener el ID de la persona recién creada
        $idPersona = $connection->insert_id;

        // Consulta SQL para insertar el cliente asociado a la persona
        $sqlCliente = "INSERT INTO cliente(id_persona, codigo_postal, calle_dir, num_dir) VALUES ($idPersona, " . ($codigo_postal ? "'$codigo_postal'" : "NULL") . ", " . ($calle_dir ? "'$calle_dir'" : "NULL") . ", " . ($num_dir ? $num_dir : "NULL") . ");";
        
        // Ejecuta la consulta para el cliente
        $respuestaCliente = $connection->query($sqlCliente);
    
        // Verifica si hubo un error al agregar el cliente
        if (!$respuestaCliente) {
            return new Respuesta(false, "Error al agregar el cliente: " . $connection->error, null);
        }
    
        // Retorna una respuesta exitosa
        return new Respuesta(true, "Usuario y cliente registrados correctamente", null);
    }
    
    // Método para registrar un administrador
    function registerAdmin($correo, $contraseña, $nombre, $apellido) {
        // Hashea la contraseña
        $hash = password_hash($contraseña, PASSWORD_BCRYPT);
    
        // Inserta en la tabla persona
        $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES ('$correo', '$hash', '$nombre', '$apellido')";
        $connection = connection();
        $respuesta = $connection->query($sqlPersona);
    
        if (!$respuesta) {
            return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
        }
    
        $id_persona = $connection->insert_id; // Obtiene el ID
    
        // Inserta en la tabla admin
        $sqlAdmin = "INSERT INTO admin (id_persona) VALUES ('$id_persona')";
        $respuestaAdmin = $connection->query($sqlAdmin);
    
        if (!$respuestaAdmin) {
            return new Respuesta(false, "Error al agregar el administrador: " . $connection->error, null);
        }
    
        return new Respuesta(true, "Administrador registrado correctamente", null);
    }
    

    // Método para iniciar sesión
    public function login($correo, $contraseña) {
        // Consulta SQL para buscar al usuario por correo
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

    // Método para cerrar sesión
    function logOut() {
        // Verifica si hay una sesión activa
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy(); // Cierra la sesión
            return new Respuesta(true, "Sesión cerrada correctamente", null);
        }
        return new Respuesta(false, "No hay sesión activa", null);
    }
}
