<?php
require_once '../conexion/conexion.php';

class envio
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM envio ";
        $respuesta = $connection->query($sql);
        $envios = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $envios;
    }
    public function agregar($nombre, $apellido,$fecha_envio, $id_ciudad, $calle_dir, $num_dir, $codigo_postal,$id_pedido){
        $sql = "INSERT INTO envio VALUES(0, $nombre,$fecha_envio, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal,$id_pedido);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_envio){
        $sql = "DELETE FROM envio WHERE id_envio= $id_envio;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_envio,$fecha_envio, $nombre, $apellido, $id_ciudad, $calle_dir, $num_dir, $codigo_postal,$id_pedido ){
        $sql = "UPDATE envio SET nombre=$nombre,fecha_envio=$fecha_envio, apellido=$apellido, id_ciudad=$id_ciudad, calle_dir=$calle_dir, num_dir=$num_dir, codigo_postal=$codigo_postal, id_pedido=$id_pedido WHERE id_envio= $id_envio;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}