<?php
require_once "../conexion/conexion.php";

class ProductoDao{
    public function verProductos(){



    }
    
    
    public function verCatalogo(){
    
    
    }
    
    
    public function agregarProducto( $tipo,$precio, $color,$estado){
    
    
        return new Respuesta(true,"agregado correctamente",null);
        
    
    }
    
    public function eliminarProducto(){
    
    
    }
}
