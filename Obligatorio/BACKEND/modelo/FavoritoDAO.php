<?php


function agregarFavorito(){


}


function eliminarFavorito(){
 

}


function verFavoritos(){
    $connection = connection();
    $sql = "SELECT * FROM Favorito";
    $respuesta = $connection->query($sql);
    $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $usuarios;

    
}