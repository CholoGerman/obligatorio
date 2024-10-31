<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';

class CarritoDao {

    function realizarCompra($productos, $metodo_pago, $calle, $numero, $telefono, $codigo_postal, $id_cliente) {
        $connection = connection();
        
        $sql_envio = "INSERT INTO envio (num_dir, calle_dir, codigo_postal, moneda) VALUES ('$numero', '$calle', '$codigo_postal', 'UYU')";
        if (!$connection->query($sql_envio)) {
            die("Error en la consulta de envío: " . $connection->error);
        }
        $id_envio = $connection->insert_id;
    
        $sql_pedido = "INSERT INTO pedido (id_cliente, fecha, metodo, id_envio) VALUES ('$id_cliente', CURRENT_DATE, '$metodo_pago', '$id_envio')";

        if (!$connection->query($sql_pedido)) {
            die("Error en la consulta de pedido: " . $connection->error);
        }
        $id_nuevo_pedido = $connection->insert_id;
    
        foreach ($productos as $producto) {
            $id_repuesto = $producto->id_repuesto; 
            $cantidad = $producto->cantidad;
            if (!$this->agregarDetalle($id_nuevo_pedido, $id_repuesto, $cantidad)) {
                die("Error al agregar detalle para el producto: $id_repuesto");
            }
            if (!$this->modificarStock($id_repuesto, $cantidad)) {
                die("Error al modificar stock para el producto: $id_repuesto");
            }
        }
    
        $sql_telefono = "INSERT INTO cliente_telefono (id_cliente, telefono) VALUES ($id_cliente, '$telefono')";
        if (!$connection->query($sql_telefono)) {
            die("Error al insertar teléfono del cliente: " . $connection->error);
        }
    
        return $id_nuevo_pedido;
    }
    
    
    
    
    
    
    
    

    function agregarDetalle($id_pedido, $id_repuesto, $cantidad) {
        // Inserta el detalle del pedido
        $precio = $this->obtenerPrecioRepuesto($id_repuesto);
        $sql = "INSERT INTO detalle (id_pedido, id_repuesto, cantidad, precio, estado) VALUES ($id_pedido, $id_repuesto, $cantidad, $precio, 'activo')";

        $connection = connection();
        return $connection->query($sql);  // Retorna si se agregó correctamente
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
        return $connection->query($sql);  // Retorna si se actualizó correctamente
    }
}
