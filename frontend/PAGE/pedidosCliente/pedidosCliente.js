import PedidoDao from "../../DAO/pedidoDAO.js";

window.onload = async () => {
    // Obtener el ID del cliente desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const clienteId = urlParams.get('id_cliente');  // Asegúrate de que 'id_cliente' esté en la URL

    if (clienteId) {
        let pedidos = await new PedidoDao().obtenerPedidosCliente(clienteId);
        mostrarPedidos(pedidos);
    } else {
        console.error("No se encontró el ID del cliente en la URL.");
    }
};

function mostrarPedidos(pedidos) {
    console.log("Pedidos recibidos:", pedidos);  
    if (pedidos.length === 0) {
        console.log("No se han recibido pedidos.");
        return; 
    }

    let tbodyElement = document.querySelector("#contenedor_pedidos");
    tbodyElement.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos pedidos

    pedidos.forEach((pedido) => {
        let precio = parseFloat(pedido.precio);
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
            </div>  
        `;
    });
}
