<?php
require_once "../conexion/conexion.php";
require_once '../modelo/Repuesta.php';

class CarritoDao
{

    function realizarCompra($productos, $metodo_pago, $nombre, $apellido, $calle, $numero, $telefono, $codigo_postal, $id_cliente, $id_persona) {
        $connection = connection();
    
        // Validar productos
        if (is_string($productos)) {
            $productos = json_decode($productos, true);
          
        }
        if (!is_array($productos) || empty($productos)) {
            error_log("Productos no es un array o está vacío.");
            return false;
        }
    
        // Insertar envío
        $sql_envio = "INSERT INTO envio (num_dir, calle_dir, codigo_postal, moneda) VALUES ('$numero', '$calle', '$codigo_postal', 'UYU')";
        if (!$connection->query($sql_envio)) {
            error_log("Error en la consulta de envío: " . $connection->error);
            return false;
        }
        $id_envio = $connection->insert_id;
    
        // Insertar pedido
        $sql_pedido = "INSERT INTO pedido (id_cliente, fecha, metodo, id_envio) VALUES ('$id_cliente', CURRENT_DATE, '$metodo_pago', '$id_envio')";
        if (!$connection->query($sql_pedido)) {
            error_log("Error en la consulta de pedido: " . $connection->error);
            return false;
        }
        $id_nuevo_pedido = $connection->insert_id;
    
        foreach ($productos as $producto) {
            if (!isset($producto['id_repuesto'], $producto['cantidad'], $producto['precio'])) {
                error_log("Elemento de producto inválido: " . json_encode($producto));
                continue;
            }
        
            $id_repuesto = $producto['id_repuesto'];
            $cantidad = $producto['cantidad'];
            $precio_unitario = $producto['precio'];
       
        
            // Insertar detalle con el precio total
            $sql_detalle = "INSERT INTO detalle (id_pedido, cantidad, precio, estado) VALUES ('$id_nuevo_pedido', '$cantidad', '$precio_unitario', 'pendiente')";
            if (!$connection->query($sql_detalle)) {
                error_log("Error al agregar detalle para el pedido: " . $connection->error);
                return false;
            }
            $id_nuevo_detalle = $connection->insert_id;
        
            // Insertar relación en detalle_repuesto
            $sql_detalle_repuesto = "INSERT INTO detalle_repuesto (ID_Detalle, ID_Repuesto) VALUES ('$id_nuevo_detalle', '$id_repuesto')";
            if (!$connection->query($sql_detalle_repuesto)) {
                error_log("Error al agregar relación detalle_repuesto: " . $connection->error);
                return false;
            }
        
            // Modificar stock
            $sql_modificar_stock = "UPDATE repuesto SET stock = stock - '$cantidad' WHERE id_repuesto = '$id_repuesto'";
            if (!$connection->query($sql_modificar_stock)) {
                error_log("Error al modificar stock para el producto: " . $connection->error);
                return false;
            }
        }
        
    
   // Verificar si el teléfono ya está registrado con el mismo id_cliente
$sql_check_telefono = "SELECT COUNT(*) as count FROM cliente_telefono WHERE telefono = '$telefono' AND id_cliente = $id_cliente";
$result_check = $connection->query($sql_check_telefono);
$telefono_existente = $result_check->fetch_assoc();

if ($telefono_existente['count'] > 0) {
    // Si ya existe el teléfono para este cliente, no lo insertamos
    error_log("El teléfono ya está registrado para el cliente con id_cliente: " . $id_cliente);
    return false;  // O cualquier mensaje que quieras devolver
} else {
    // Si el teléfono no existe para este cliente, lo insertamos
    $sql_telefono = "INSERT INTO cliente_telefono (id_cliente, telefono) VALUES ($id_cliente, '$telefono')";
    if (!$connection->query($sql_telefono)) {
        error_log("Error al insertar teléfono del cliente: " . $connection->error);
        return false;
    }
    return true;  // O cualquier valor de éxito que quieras devolver
}
    
        return $id_nuevo_pedido;
    }
    



    function agregarDetalle($id_pedido, $id_repuesto, $cantidad)
    {
        // Inserta el detalle del pedido
        $precio = $this->obtenerPrecioRepuesto($id_repuesto);
        $sql = "INSERT INTO detalle (id_pedido, id_repuesto, cantidad, precio, estado) VALUES ($id_pedido, $id_repuesto, $cantidad, $precio, 'activo')";

        $connection = connection();
        return $connection->query($sql);  // Retorna si se agregó correctamente
    }

    function obtenerPrecioRepuesto($id_repuesto)
    {
        $sql = "SELECT precio FROM repuesto WHERE id_repuesto = $id_repuesto";
        $connection = connection();
        $respuesta = $connection->query($sql);

        if ($respuesta) {
            $row = $respuesta->fetch_assoc();
            return $row['precio'];
        }
        return 0;  // Retorna 0 si no se encuentra el repuesto
    }

    function modificarStock($id_repuesto, $cantidad)
    {
        // Actualiza el stock del repuesto
        $sql = "UPDATE repuesto SET stock = stock - $cantidad WHERE id_repuesto = $id_repuesto";
        $connection = connection();
        return $connection->query($sql);  // Retorna si se actualizó correctamente
    }
}
