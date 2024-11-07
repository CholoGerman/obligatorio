window.onload = () => {
    console.log("Script comprar.js cargado");
    
    let datosCompra = JSON.parse(sessionStorage.getItem('datosCompra')) || [];
    
    if (datosCompra.length === 0) {
        alert("No hay productos en la compra.");
        window.location.href = '../carrito.html';
        return;
    }

    document.getElementById('formCompra').addEventListener('submit', async (event) => {
        event.preventDefault();
        await realizarCompra();
    });
}

async function realizarCompra() {
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
    let id_cliente = sessionStorage.getItem('usuarioId');

    if (!id_cliente) {
        alert("No se encontró el ID de cliente. Por favor, inicia sesión.");
        return;
    }

    // Crear un objeto FormData
    let formData = new FormData();
    formData.append('productos', JSON.stringify(datosCompra)); // Convertir productos a JSON
    formData.append('metodo_pago', metodoPago);
    formData.append('nombre', nombre);
    formData.append('apellido', apellido);
    formData.append('calle', calle);
    formData.append('numero', numero);
    formData.append('telefono', telefono);
    formData.append('codigo_postal', codigoPostal);
    formData.append('id_cliente', id_cliente);

    let response = await fetch('http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar', {
        method: 'POST',
        body: formData // Enviar como FormData
    });

    if (response.ok) {
        let result = await response.json();
        console.log(result);
        document.getElementById('mensajeExito').style.display = 'block';
    } else {
        console.error("Error en la compra");
    }
}



// efecto alerta: 

document.getElementById('formCompra').addEventListener('submit', function(e) {
    e.preventDefault(); 

    let mensajeExito = document.getElementById('mensajeExito');
    
    mensajeExito.style.display = "block";
    
 
    mensajeExito.offsetHeight; 
    
 
    mensajeExito.classList.add('show'); 
    

    setTimeout(function() {
        mensajeExito.classList.remove('show');
        

        setTimeout(function() {
            mensajeExito.style.display = "none"; 
        }, 500); 
    }, 4000); 
});
