import PedidoDao from "../../DAO/pedidoDAO.js";

window.onload = async () => {
    let pedidos = await new PedidoDao().obtenerPedidos();
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
                <p>ID Cliente: ${pedido.id_cliente}</p>
                <p>ID Pedido: ${pedido.id_pedido}</p>
                <p>Fecha: ${pedido.fecha}</p>
                <p>Método: ${pedido.metodo}</p>
                <p>Cantidad: ${pedido.cantidad}</p>
                <p>Precio: ${isNaN(precio) ? 'N/A' : precio.toFixed(2)} €</p>
                <p>Número de Dirección: ${pedido.num_dir}</p>
                <p>Calle: ${pedido.calle_dir}</p>
                <p>Código Postal: ${pedido.codigo_postal}</p>

                <label> Estado: </label>
                <select class="estado-pedido" data-id="${pedido.id_pedido}" required>
                    <option value="Enviado">Enviado</option>
                    <option value="En camino">En camino</option>
                    <option value="Entregado">Entregado</option>
                </select>
                

                <a class="eliminar" data-id="${pedido.id_pedido}">
                    <img src="../../../backend/IMG/icon_eliminar.png" alt="Eliminar" height="45px">
                </a>
                
                <a>
                    <img src="../../../backend/IMG/info icon.png" alt="Información" height="55px">
                </a>

                <button>Aceptar</button>
            </div>  
        `;
    });

}


document.querySelectorAll('.estado-pedido').forEach(select => {
    select.addEventListener('change', async (event) => {
        let nuevoEstado = event.target.value;
        let idPedido = event.target.getAttribute('data-id');
        console.log(`Cambiar estado de pedido ID ${idPedido} a: ${nuevoEstado}`);


        await new PedidoDao().cambiarEstadoPedido(idPedido, nuevoEstado);


        event.target.style.backgroundColor = 'lightgreen'; 
    });
});