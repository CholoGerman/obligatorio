import PedidoDao from "../../DAO/pedidoDAO.js";

window.onload = async () => {
    // Obtener el ID del cliente desde sessionStorage
    let clienteId = sessionStorage.getItem('clienteId');

    console.log("Cliente ID obtenido:", clienteId);

    if (clienteId) {
        try {
            let pedidos = await new PedidoDao().obtenerPedidosCliente(clienteId);
            mostrarPedidos(pedidos);
        } catch (error) {
            console.error("Error al obtener los pedidos:", error);
        }
    } else {
        console.error("No se encontró el ID del cliente en sessionStorage.");
        alert("Error: No se encontró el ID del cliente en la sesión.");
    }
};

function mostrarPedidos(pedidos) {
    console.log("Pedidos recibidos:", pedidos);
    if (!pedidos || pedidos.length === 0) {
        console.log("No se han recibido pedidos.");
        return;
    }

    let tbodyElement = document.querySelector("#contenedor_pedidos");
    tbodyElement.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos pedidos

    pedidos.forEach((pedido) => {

        let precio = parseFloat(pedido.precio);  // Convertir a número
        tbodyElement.innerHTML += `
            <div class="producto" data-id="${pedido.id_pedido}">
                <p>ID Pedido: ${pedido.id_pedido}</p>
                <p>Fecha: ${pedido.fecha}</p>
                <p>Método: ${pedido.metodo}</p>
                <p>Cantidad: ${pedido.cantidad}</p>
                <p>Precio: ${isNaN(precio) ? 'N/A' : precio.toFixed(2)} €</p>
                <p>Número de Dirección: ${pedido.num_dir}</p>
                <p>Calle: ${pedido.calle_dir}</p>
                <p>Estado: ${pedido.estado}</p>
            </div>  
        `;
    });
}
