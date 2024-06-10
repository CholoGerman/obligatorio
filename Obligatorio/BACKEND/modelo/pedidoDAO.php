<?php
require_once '../conexion/conexion.php';

class pedido
{

    function obtener()
    {
        $connection = connection();
        $sql = "SELECT * FROM pedido ";
        $respuesta = $connection->query($sql);
        $pametodoentes = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pametodoentes;
    }
    public function agregar($fecha, $metodo_pago, $ID_cliente){
        $sql = "INSERT INTO pedido VALUES(0, $fecha '$metodo_pago', $ID_cliente);"; // fecha (date) va entre comilla simple?
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($ID_pedido){
        $sql = "DELETE FROM pedido WHERE ID_pedido= $ID_pedido;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($ID_pedido, $fecha, $metodo_pago, $ID_cliente){
        $sql = "UPDATE pedido SET fecha=$fecha, metodo_pago=$metodo_pago, ID_cliente=$ID_cliente WHERE ID_pedido= $ID_pedido;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>