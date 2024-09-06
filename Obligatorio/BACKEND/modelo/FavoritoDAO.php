<?php
require_once "../conexion/conexion.php";

class FavoritoDao
{

    function agregarFavorito() {
        //dudas

        return new Respuesta(true, "Agregado correctamente", null);
    }


    function eliminarFavorito(){
        //dudas
     
        return new Respuesta(true, "Eliminado correctamente", null);
    }


    function obtenerFavoritos(){
       
    }
}
