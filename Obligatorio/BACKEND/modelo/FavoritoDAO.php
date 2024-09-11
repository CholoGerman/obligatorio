<?php
require_once "../conexion/conexion.php";

class FavoritoDao
{

    function agregarFavorito($correo,$id_repuesto) {
        $sql = "INSERT INTO favorito (correo, id_repuesto) VALUES ('$correo', $id_repuesto);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "Agregado correctamente", null);
    }


    function eliminarFavorito($correo,$id_repuesto){
      
    $sql = "DELETE FROM favorito WHERE correo = '$correo' AND id_repuesto = $id_repuesto;";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
        return new Respuesta(true, "Eliminado correctamente", null);
    }


    function obtenerFavoritos($correo){
    $connection = connection();
    $sql = "SELECT * FROM Favorito where correo = '$correo';";
    $respuesta = $connection->query($sql);
    $favorito = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $favorito;
    }
}
