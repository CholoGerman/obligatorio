<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
session_start();
class SesionDao{


        function register($correo, $contraseña, $nombre, $apellido) { // Función para registrar un usuario
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);
            $sql = "INSERT INTO persona(correo, contraseña, nombre, apellido) VALUES ('$correo', '$hash', '$nombre', '$apellido');";
            
            $connection = connection();
            $connection->query($sql);
            
            return new Respuesta(true, "Usuario agregado correctamente", null);
        }
    
        function login($correo, $contraseña) { // Función para iniciar sesión
            $sql = "SELECT * FROM persona WHERE correo='$correo'";
            $connection = connection();
            $respuesta = $connection->query($sql);
            $usuario = $respuesta->fetch_assoc();
    
            if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
                $_SESSION["session"] = $usuario;
                return new Respuesta(true, "Inicio de sesión exitoso", null);
            } else {
                return new Respuesta(false, "Correo o contraseña incorrectos", null);
            }
        }
    
        function logOut() { // Función para cerrar sesión
            $_SESSION["session"] = null;
            return new Respuesta(true, "Sesión cerrada correctamente", null);
        }
    }
    


