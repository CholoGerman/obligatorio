export default class CarritoController {


    async realizarCompra(nombre, apellido, departamento, ciudad, calle, numero, telefono,id_repuesto) {
        //preguntar si necesita informacion
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/CarritoController.php?funcion=comprar";
        formData.append("nombre",nombre);
        formData.append("apellido",apellido);
        formData.append("departamento",departamento);
        formData.append("ciudad",ciudad);
        formData.append("calle",calle);
        formData.append("numero",numero);
        formData.append("telefono",telefono);
        formData.append("id_repuesto",id_repuesto);
      
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
    
    
    }
    async agregarDetalle(id_pedido){
    
        let url ="http://localhost/obligatorio/obligatorio-1/Obligatorio/BACKEND/controlador/CarritoController.php?funcion=factura";
        let formData = new FormData();
        formData.append("id_pedido",id_pedido);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
        
    }
    async modificarStock(id_repuesto, cantidad){
    
        let url ="http://localhost/obligatorio/obligatorio-1/Obligatorio/BACKEND/controlador/CarritoController.php?funcion=stock";
        let formData = new FormData();
        formData.append("id_repuesto",id_repuesto);
        formData.append("cantidad",cantidad);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
    
        
    }
    }

