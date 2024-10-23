document.getElementById('formCompra').addEventListener('submit', async (event) => {
    event.preventDefault(); // Evita el envío del formulario por defecto

    let departamento = document.getElementById('departamento').value;
    let ciudad = document.getElementById('ciudad').value;
    let direccion = document.getElementById('direccion').value;
    let telefono = document.getElementById('telefono').value;
    let metodo_pago = document.getElementById('metodo_pago').value;

    // Aquí asumo que tienes el id_repuesto y la cantidad en algún lugar
    let id_repuesto = $id_repuesto; // Cambia esto por el id real
    let cantidad = $cantidad; // Cambia esto por la cantidad real

    // Prepara los datos para enviar
    let datos = {
        departamento,
        ciudad,
        direccion,
        telefono,
        metodo_pago,
        id_repuesto,
        cantidad
    };

    try {
        let response = await fetch('http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        let result = await response.json();

        if (result.success) {
            alert("Compra realizada con éxito!");
            // Redirecciona o realiza alguna acción después de la compra
        } else {
            alert("Error al realizar la compra: " + result.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Hubo un error al realizar la compra.");
    }
});


document.addEventListener("DOMContentLoaded", () => {

    const cliente = {
        nombre: "Juan",
        apellido: "Pérez"
    };

    // Asignar el nombre y apellido a los campos del formulario
    document.getElementById("nombre").value = cliente.nombre;
    document.getElementById("apellido").value = cliente.apellido;
});


async function obtenerDatosCliente(id_cliente) {
    try {
        const response = await fetch(`controlador/obtenerCliente.php?id_cliente=${id_cliente}`);
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        const cliente = await response.json();

        // Asignar el nombre y apellido a los campos del formulario
        document.getElementById("nombre").value = cliente.nombre || '';
        document.getElementById("apellido").value = cliente.apellido || '';
    } catch (error) {
        console.error('Error al obtener los datos del cliente:', error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const id_cliente = 1; // Cambia esto por el ID del cliente actual
    obtenerDatosCliente(id_cliente);
});


