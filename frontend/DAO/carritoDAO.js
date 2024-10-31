class CarritoDao {
    async realizarCompra(datos) {
        let formData = new FormData();

        // Agregar datos del formulario
        formData.append("nombre", datos.nombre);
        formData.append("apellido", datos.apellido);
        formData.append("departamento", datos.departamento);
        formData.append("ciudad", datos.ciudad);
        formData.append("calle", datos.calle);
        formData.append("numero", datos.numero);
        formData.append("telefono", datos.telefono);
        formData.append("metodo_pago", datos.metodo_pago);
        formData.append("id_cliente", datos.id_cliente); // Asegúrate de que esto sea correcto
        formData.append("codigo_postal", datos.codigo_postal); 

        // Agregar todos los productos del carrito
        datos.productos.forEach(producto => {
            formData.append("productos[]", JSON.stringify(producto)); // Enviar cada producto como un JSON
        });

        try {
            let respuesta = await fetch('http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar', {
                method: 'POST',
                body: formData,
            });
    
            // Imprimir la respuesta del servidor para depuración
            let textResponse = await respuesta.text(); // Obtener la respuesta como texto
            console.log("Respuesta del servidor:", textResponse); // Ver la respuesta
    
            let resultado = JSON.parse(textResponse); // Intentar parsear el JSON
            return resultado; // Devolver el resultado
        } catch (error) {
            console.error("Error al enviar datos:", error);
            throw error; // Propagar el error
        }
    }
    }


export default CarritoDao;
