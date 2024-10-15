<?php
require_once "../conexion/conexion.php";

class CarritoDao{

function realizarCompra($cantidad, $id_repuesto, $id_pedido, $metodo_pago, $id_cliente){   //Funcion para realizar una compra
    $sql = "INSERT INTO pedido( fecha, metodo_pago, id_cliente) VALUES (0, CURRENT_DATE ,$metodo_pago,$id_cliente)"; 

    $connection = connection();
    $respuesta = $connection->query($sql);
    if($respuesta){
        $detalle=$this->agregarDetalle($id_repuesto, $id_pedido);  //Llamar a la funcion agregar detalle

        if ($detalle){
            $this->modificarStock($id_repuesto, $cantidad); //Llamar a la funcion modificar stock
        }
    }
    return new Respuesta(true, "Agregado correctamente", null);
}

function agregarDetalle($id_pedido){  //Funcion para mostrar una factura
    $sql = "SELECT 
    p.id_pedido, 
    p.fecha, 
    p.metodo_pago,
    c.usuario AS cliente_usuario,
    CONCAT(perso.nombre, ' ', perso.apellido) AS nombre_completo, dp.cantidad, r.tipo AS repuesto_tipo, 
     r.precio AS repuesto_precio_unitario,
    dp.precio_total,
    (dp.cantidad * r.precio) AS total_item FROM pedido p
INNER JOIN
    cliente c ON p.id_cliente = c.id_cliente
INNER JOIN
    persona perso ON c.id_persona = perso.id_persona
INNER JOIN
    detalle_pedido dp ON p.id_pedido = dp.id_pedido
INNER JOIN
    repuesto r ON dp.id_repuesto = r.id_repuesto
WHERE
    p.id_pedido = $id_pedido;";  
    $connection = connection(); 
    $respuesta = $connection->query($sql);
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC); 
    return $resultado;
}

function modificarStock($id_repuesto, $cantidad){  //Funcion para modificar el stock
    $sql = "UPDATE repuesto SET stock=$cantidad WHERE id_repuesto = $id_repuesto"; 
    $connection = connection();
    $respuesta = $connection->query($sql);
    return $respuesta;
}


}