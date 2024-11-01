class CarritoDao {
    async realizarCompra() {
        let datosCompra = JSON.parse(sessionStorage.getItem('datosCompra')) || [];
        if (datosCompra.length === 0) {
            alert("No hay productos para comprar.");
            return;
        }
    
        // Obtener los datos del formulario
        let metodoPago = document.getElementById('metodo_pago').value;
        let nombre = document.getElementById('nombre').value;
        let apellido = document.getElementById('apellido').value;
        let calle = document.getElementById('direccion').value;
        let numero = document.getElementById('numero').value;
        let telefono = document.getElementById('telefono').value;
        let codigoPostal = document.getElementById('codigo_postal').value;
        let id_cliente = sessionStorage.getItem('usuarioId'); // Debería devolver '8'
    
        if (!id_cliente) {
            alert("No se encontró el ID de cliente. Por favor, inicia sesión.");
            return; // Detiene la ejecución si no hay ID de cliente
        }
    
        console.log("Iniciando la compra...");
    
        let formData = new URLSearchParams();
        formData.append('productos', JSON.stringify(datosCompra)); // Convertir productos a JSON string
        formData.append('metodo_pago', metodoPago);
        formData.append('nombre', nombre);
        formData.append('apellido', apellido);
        formData.append('calle', calle);
        formData.append('numero', numero);
        formData.append('telefono', telefono);
        formData.append('codigo_postal', codigoPostal);
        formData.append('id_cliente', id_cliente); // Agrega el id_cliente también
    
        let response = await fetch('http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar', {
            method: 'POST',
            body: formData // Envía el URLSearchParams
        });
    
        if (response.ok) {
            let result = await response.json();
            console.log(result);
            document.getElementById('mensajeExito').style.display = 'block'; // Mostrar mensaje de éxito
        } else {
            console.error("Error en la compra");
        }
    }
    
    }


export default CarritoDao;
