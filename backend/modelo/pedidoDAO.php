<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';
class PedidoDao{
    function obtenerPedido($id_pedido) {
        $connection = connection();
        $sql = "
            SELECT p.id_pedido, p.id_cliente, p.fecha, p.metodo, 
                   d.cantidad, d.precio, 
                   e.num_dir, e.calle_dir, e.codigo_postal
            FROM Pedido p
            JOIN detalle d ON p.id_pedido = d.id_pedido
            JOIN envio e ON p.id_envio = e.id_envio
            WHERE p.id_pedido = $id_pedido;
        ";
        $respuesta = $connection->query($sql);
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
        return $pedidos;
    }
    

function obtenerPedidos() {
    $connection = connection();
    $sql = "
        SELECT p.id_pedido, p.id_cliente, p.fecha, p.metodo, 
               d.cantidad, d.precio, 
               e.num_dir, e.calle_dir, e.codigo_postal
        FROM Pedido p
        JOIN detalle d ON p.id_pedido = d.id_pedido
        JOIN envio e ON p.id_envio = e.id_envio;
    ";
    $respuesta = $connection->query($sql);
    $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $pedidos;
}

function obtenerPedidosCliente($id_cliente){
    if ($id_cliente == NULL) {
        return []; // O lanzar un error si prefieres
    }
    $connection = connection();
    $sql = "
        SELECT p.id_pedido, p.fecha, p.metodo, 
               d.cantidad, d.precio, 
               e.num_dir, e.calle_dir, e.codigo_postal
        FROM Pedido p
        JOIN detalle d ON p.id_pedido = d.id_pedido
        JOIN envio e ON p.id_envio = e.id_envio
        WHERE p.id_cliente = $id_cliente;
    ";
    $respuesta = $connection->query($sql);
    if (!$respuesta) {
        // Log de error si la consulta falla
        error_log("Error en la consulta SQL: " . $connection->error);
        return []; // Retorna un arreglo vacío si la consulta falla
    }
    $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    return $pedidos;
}



function cambiarEstadoPedido($id_pedido, $estado) {
    $connection = connection();
    $sql = "UPDATE detalle SET estado = '$estado' WHERE id_pedido = $id_pedido;";       
    $respuesta = $connection->query($sql);
    return new Respuesta(true, "Estado actualizado", null);
}


}