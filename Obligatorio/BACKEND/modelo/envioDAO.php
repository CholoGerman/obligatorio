<?php
require_once '../conexion/conexion.php';

class envio
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los envios
        $connection = connection();
        $sql = "SELECT * FROM envio ";
        $respuesta = $connection->query($sql);
        $envios = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $envios;
    }
    public function agregar($fecha_envio, $peso, $costo, $id_ciudad, $codigo_postal, $calle_dir,$num_dir, $id_pedido){ //Funcion que indica los parametros y consulta sql a utilizar para agregar un envio
        $sql = "INSERT INTO envio VALUES(0, '$peso', '$fecha_envio', $costo, '$id_ciudad', '$codigo_postal', '$calle_dir', '$num_dir', $id_pedido);";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_envio){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar un envio
        $sql = "DELETE FROM envio WHERE id_envio= $id_envio;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_envio, $peso, $fecha_envio, $costo, $id_ciudad, $codigo_postal, $calle_dir,$num_dir, $id_pedido ){  //Funcion que indica los parametros y consulta sql a utilizar para editar un envio
        $sql = "UPDATE envio SET peso='$peso', fecha_envio='$fecha_envio', costo=$costo, id_ciudad=$id_ciudad, codigo_postal='$codigo_postal', calle_dir='$calle_dir', num_dir='$num_dir', $id_pedido=id_pedido WHERE id_envio= $id_envio;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}