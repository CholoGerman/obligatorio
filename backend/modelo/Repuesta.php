<?php
    class Respuesta{   //codigo recibido por Alexis Aquino
        public $status;
        public $mensaje;
        public $datos;
        function __construct($status,$mensaje,$datos)
        {
            $this->status=$status;
            $this->mensaje=$mensaje;
            $this->datos=$datos;
        }
    }
?>