<?php
require_once '../conexion/conexion.php';

class pedido
{

    function obtener(){ //Funcion que indica la consulta sql a utilizar para mostrar los pedidos
        $connection = connection();
        $sql = "SELECT * FROM pedido ";
        $respuesta = $connection->query($sql);
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pedidos;
    }
    public function agregar($fecha, $metodo_pago, $id_cliente){ //Funcion que indica los parametros y consulta sql a utilizar para agregar un pedido
        $sql = "INSERT INTO pedido VALUES(0, '$fecha' ,'$metodo_pago', $id_cliente);"; 
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
    public function eliminar($id_pedido){ //Funcion que indica los parametros y consulta sql a utilizar para eliminar un pedido
        $sql = "DELETE FROM pedido WHERE id_pedido= $id_pedido;";
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }

    public function editar($id_pedido, $fecha, $metodo_pago, $id_cliente){  //Funcion que indica los parametros y consulta sql a utilizar para editar un pedido
        $sql = "UPDATE pedido SET fecha='$fecha', metodo_pago='$metodo_pago', id_cliente=$id_cliente WHERE id_pedido= $id_pedido;";  
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;
    }
}
?>