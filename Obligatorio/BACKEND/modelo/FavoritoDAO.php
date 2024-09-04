<?php
require_once "../conexion/conexion.php";

class FavoritoDao{

function agregarFavorito(){

// codigo a sql

    return new Respuesta(true,"Agregado correctamente",null);

}


function eliminarFavorito(){
 
// codigo a sql
    return new Respuesta(true,"Eliminado correctamente",null);

}


function obtenerFavoritos(){
    $connection = connection();
    $sql = "SELECT * FROM Favorito";
    $respuesta = $connection->query($sql);
    $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $usuarios;

    
}

}