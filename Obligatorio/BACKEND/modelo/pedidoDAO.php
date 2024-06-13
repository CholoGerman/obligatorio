<?php
require_once '../conexion/conexion.php';

class pedido
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM pedido ";
        $respuesta = $connection->query($sql);
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pedidos;
    }
    public function agregar($fecha, $metodo_pago, $id_cliente){
        $sql = "INSERT INTO pedido VALUES(0, '$fecha' ,'$metodo_pago', $id_cliente);"; 
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_pedido){
        $sql = "DELETE FROM pedido WHERE id_pedido= $id_pedido;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_pedido, $fecha, $metodo_pago, $id_cliente){
        $sql = "UPDATE pedido SET fecha=$fecha, metodo_pago=$metodo_pago, id_cliente=$id_cliente WHERE id_pedido= $id_pedido;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>