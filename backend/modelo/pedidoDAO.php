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
                   SUM(d.precio * d.cantidad) AS precio_total,  -- Sumar el precio por cantidad
                   SUM(d.cantidad) AS cantidad_total,  -- Sumar las cantidades de productos por pedido
                   e.num_dir, e.calle_dir, e.codigo_postal
            FROM Pedido p
            JOIN detalle d ON p.id_pedido = d.id_pedido
            JOIN envio e ON p.id_envio = e.id_envio
            GROUP BY p.id_pedido;
        ";
        $respuesta = $connection->query($sql);
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
        
      
        foreach ($pedidos as &$pedido) {
            $pedido['precio_total'] = (float)$pedido['precio_total'];  // Convertir a float
            $pedido['cantidad_total'] = (int)$pedido['cantidad_total'];  // Convertir a entero
        }
        
        // Verificar los datos
        error_log("Pedidos obtenidos: " . print_r($pedidos, true));
        
        return $pedidos;
    }
    
    
    
    function obtenerPedidosCliente($id_cliente) {
        $connection = connection();
        $sql = "
           SELECT p.id_pedido, p.fecha, p.metodo, 
                  d.cantidad, d.precio, d.estado,
                  (d.cantidad * d.precio) AS precio_total,  
                  e.num_dir, e.calle_dir, e.codigo_postal
           FROM Pedido p
           JOIN detalle d ON p.id_pedido = d.id_pedido
           JOIN envio e ON p.id_envio = e.id_envio
           WHERE p.id_cliente = ?;
        ";
    
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            die("Error preparando la consulta: " . $connection->error);
        }
    
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $respuesta = $stmt->get_result();
    
        $pedidos = $respuesta->fetch_all(MYSQLI_ASSOC);
    
        // Log para verificar los resultados antes de devolverlos
        error_log("Pedidos obtenidos: " . print_r($pedidos, true));
    
        $stmt->close();
        return $pedidos;
    }
    
    


function cambiarEstadoPedido($id_pedido, $estado) {
    $connection = connection();
    $sql = "UPDATE detalle SET estado = '$estado' WHERE id_pedido = $id_pedido;";       
    $respuesta = $connection->query($sql);
    return new Respuesta(true, "Estado actualizado", null);
}


}