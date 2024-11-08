import PedidoDao from "../../DAO/pedidoDAO.js";

window.onload = async () => {
    let pedidos = await new PedidoDao().obtenerPedidosCliente();
    mostrarPedidos(pedidos);
};

function mostrarPedidos(pedidos) {
    console.log("Catálogo recibido:", pedidos);  
    if (pedidos.length === 0) {
        console.log("No se han recibido pedidos.");
        return; 
    }

    let tbodyElement = document.querySelector("#contenedor_pedidos");
    tbodyElement.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos pedidos

    pedidos.forEach((pedido) => {
        let precio = parseFloat(pedido.precio);  // Convertir a número
        console.log("Precio:", precio, "Tipo:", typeof precio);  // Verifica el valor y el tipo

        // Crear el HTML para cada pedido
        tbodyElement.innerHTML += `
            <div class="producto" data-id="${pedido.id_pedido}">
                <p>ID Pedido: ${pedido.id_pedido}</p>
                <p>Fecha: ${pedido.fecha}</p>
                <p>Método: ${pedido.metodo}</p>
                <p>Cantidad: ${pedido.cantidad}</p>
                <p>Precio: ${isNaN(precio) ? 'N/A' : precio.toFixed(2)} €</p>
                <p>Número de Dirección: ${pedido.num_dir}</p>
                <p>Calle: ${pedido.calle_dir}</p>
                <p>Código Postal: ${pedido.codigo_postal}</p>

        
                
                <a>
                    <img src="../../../backend/IMG/info icon.png" alt="Información" height="55px">
                </a>

            </div>  
        `;
    });
    asignarEventListeners();
}

function asignarEventListeners() {
    // Asignamos el eventListener a los botones "Aceptar"
    document.querySelectorAll('.aceptar').forEach(button => {
        button.addEventListener('click', async (event) => {
            let idPedido = event.target.getAttribute('data-id');
            let selectEstado = document.querySelector(`.estado-pedido[data-id="${idPedido}"]`);
            let nuevoEstado = selectEstado ? selectEstado.value : 'Enviado';  // Obtener el estado seleccionado
            
            console.log(`Cambiando el estado del pedido ID ${idPedido} a: ${nuevoEstado}`);
            
            // Cambiar el estado del pedido usando la función cambiarEstadoPedido
            await new PedidoDao().cambiarEstadoPedido(idPedido, nuevoEstado);
        });
    });
}
