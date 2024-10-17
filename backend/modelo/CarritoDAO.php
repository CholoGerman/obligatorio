<?php
require_once "../conexion/conexion.php";

class CarritoDao{

    function realizarCompra($cantidad, $id_repuesto, $metodo_pago, $id_envio, $id_cliente) {
        // Inserción en la tabla pedido
        $sql = "INSERT INTO pedido(id_cliente, fecha, metodo, id_envio) VALUES ($id_cliente, CURRENT_DATE, '$metodo_pago', $id_envio)"; 
    
        $connection = connection();
        $respuesta = $connection->query($sql);
        
        if ($respuesta) {
            // Obtener el ID del nuevo pedido
            $id_nuevo_pedido = $connection->insert_id;
    
            // Agregar el detalle del pedido
            $detalle = $this->agregarDetalle($id_nuevo_pedido, $id_repuesto, $cantidad);
    
            if ($detalle) {
                // Modificar el stock del repuesto
                $this->modificarStock($id_repuesto, $cantidad);
            }
    
            // Generar y retornar la factura
            return $this->generarFactura($id_nuevo_pedido);
        }
        return new Respuesta(false, "Error al realizar la compra", null);
    }
    
    function agregarDetalle($id_pedido, $id_repuesto, $cantidad) {
        // Inserta el detalle del pedido
        $precio = $this->obtenerPrecioRepuesto($id_repuesto);
        $sql = "INSERT INTO detalle(id_pedido, cantidad, precio, estado) VALUES ($id_pedido, $cantidad, $precio, 'activo')";
    
        $connection = connection();
        $respuesta = $connection->query($sql);
    
        return $respuesta;  // Retorna si se agregó correctamente
    }
    
    function obtenerPrecioRepuesto($id_repuesto) {
        $sql = "SELECT precio FROM repuesto WHERE id_repuesto = $id_repuesto";
        $connection = connection();
        $respuesta = $connection->query($sql);
        
        if ($respuesta) {
            $row = $respuesta->fetch_assoc();
            return $row['precio'];
        }
        return 0;  // Retorna 0 si no se encuentra el repuesto
    }
    
    function modificarStock($id_repuesto, $cantidad) {
        // Actualiza el stock del repuesto
        $sql = "UPDATE repuesto SET stock = stock - $cantidad WHERE id_repuesto = $id_repuesto"; 
        $connection = connection();
        $respuesta = $connection->query($sql);
        return $respuesta;  // Retorna si se actualizó correctamente
    }
    
    function generarFactura($id_pedido) {
        $sql = "SELECT 
            p.nombre AS Nombre_Cliente,
            p.apellido AS Apellido_Cliente,
            o.id_pedido AS ID_Pedido,
            o.fecha AS Fecha_Pedido,
            d.cantidad AS Cantidad,
            r.nombre AS Nombre_Repuesto,
            r.precio AS Precio_Unitario,
            (d.cantidad * r.precio) AS Total_Por_Item,
            SUM(d.cantidad * r.precio) OVER (PARTITION BY o.id_pedido) AS Total_Factura
        FROM 
            cliente c
        JOIN 
            persona p ON c.id_persona = p.id_persona
        JOIN 
            pedido o ON c.id_cliente = o.id_cliente
        JOIN 
            detalle d ON o.id_pedido = d.id_pedido
        JOIN 
            detalle_repuesto dr ON d.id_detalle = dr.id_detalle
        JOIN 
            repuesto r ON dr.id_repuesto = r.id_repuesto
        WHERE 
            o.id_pedido = $id_pedido LIMIT 0, 25;";  
    
        $connection = connection(); 
        $respuesta = $connection->query($sql);
        $resultado = $respuesta->fetch_all(MYSQLI_ASSOC); 
        return $resultado;  // Retorna los detalles de la factura
    }
    
    


}