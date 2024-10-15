<?php

//Deshabilitar la visualización de errores
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0'); 

// Habilitar el registro de errores
ini_set('log_errors', '1');
ini_set('error_log', '../log/php_errors.log'); 

function connection() { //Creamos la conexion con la base de datos
    try{
    //Insertamos los datos de la bdd 
    $host = "localhost";
    $bd = "tallergerman";
    $usuario = "root";
    $password = "";    
    $puerto = "3306";
    $mysqli = new mysqli($host, $usuario, $password, $bd, $puerto);
    return $mysqli;



    }  catch(Exception $e){
        echo $e->getMessage();
        
    }
}

?>
