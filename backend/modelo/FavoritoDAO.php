<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
class FavoritoDao
{

    function agregarFavorito($id_cliente,$id_repuesto) { //Funcion para agregar un producto a favorito
        $sql = "INSERT INTO favorito (id_cliente, id_repuesto) VALUES ($id_cliente, $id_repuesto);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
        return new Respuesta(true, "Agregado correctamente", null);
    }


    function eliminarFavorito($id_cliente,$id_repuesto){ //Funcion para eliminar un producto de favorito
      
    $sql = "DELETE FROM favorito WHERE id_cliente = $id_cliente AND id_repuesto = $id_repuesto;";
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
        return new Respuesta(true, "Eliminado correctamente", null);
    }


    function obtenerFavoritos($id_cliente){ //Funcion para mostrar los favoritos
    $connection = connection();
    $sql = " SELECT r.*, i.extension FROM repuesto r 
                INNER JOIN imagen i ON r.id_imagen = i.id_imagen 
            FROM favorito f
            JOIN repuesto r ON p.id_pedido = d.id_pedido
            JOIN imagen i ON p.id_envio = e.id_envio
            WHERE f.id_cliente = $id_cliente";
    $respuesta = $connection->query($sql);
    $favorito = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $favorito;
    }
}
