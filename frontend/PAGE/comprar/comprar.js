import CarritoDao from "../../DAO/carritoDAO.js"; 

window.onload = () => {
    let formCompra = document.getElementById('formCompra');
    
    // Inicializa carritoDao aquí
    let carritoDao = new CarritoDao();

    formCompra.addEventListener('submit', async (event) => {
        event.preventDefault();

        let nombre = document.getElementById('nombre').value.trim();
        let apellido = document.getElementById('apellido').value.trim();
        let departamento = document.getElementById('departamento').value.trim();
        let ciudad = document.getElementById('ciudad').value.trim();
        let calle = document.getElementById('direccion').value.trim();
        let numero = document.getElementById('numero').value.trim();
        let telefono = document.getElementById('telefono').value.trim();
        let metodo_pago = document.getElementById('metodo_pago').value.trim();
        let codigo_postal = document.getElementById('codigo_postal').value.trim();

        // Obtén el ID del cliente desde la sesión
        let id_cliente = sessionStorage.getItem('usuarioId'); // Debería ser el ID del cliente
        console.log("ID de cliente al enviar:", id_cliente); 

        let datosCompra = JSON.parse(sessionStorage.getItem('datosCompra')) || [];

        let datos = {
            nombre,
            apellido,
            departamento,
            ciudad,
            calle,
            numero,
            codigo_postal,
            telefono,
            metodo_pago,
            id_cliente, // Asegúrate de que esta variable se inicialice antes de su uso
            productos: datosCompra
        };

        console.log("Datos a enviar:", datos);

        try {
            let respuesta = await carritoDao.realizarCompra(datos);
            if (respuesta.success) {
                sessionStorage.setItem('usuarioId', respuesta.id_cliente); // Guardar el id_cliente correcto
            }
            else {
                alert("Error: " + respuesta.message); // Mensaje de error
            }
        } catch (error) {
            console.error("Error al enviar datos:", error);
        }
    });
};
