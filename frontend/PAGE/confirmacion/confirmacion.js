import PedidoDao from "../../DAO/pedidoDAO.js";

window.onload = async () => {
    let pedidos = await new PedidoDao().obtenerPedidos();
    mostrarPedidos(pedidos);
};

function mostrarPedidos(pedidos) {
    console.log("Pedidos:", pedidos); // Imprime los pedidos antes de mostrarlos
    if (pedidos.length === 0) {
        console.log("No se han recibido pedidos.");
        return; 
    }

    let tbodyElement = document.querySelector("#contenedor_pedidos");
    tbodyElement.innerHTML = "";  // Limpiar el contenedor antes de agregar nuevos pedidos

    pedidos.forEach((pedido) => {
        let precio = parseFloat(pedido.precio_total);
        console.log("Precio:", precio);  // Verifica el valor de `precio_total`
        console.log("Tipo de precio:", typeof precio);  // Verifica el tipo

        // Si el precio es válido (no NaN), muestra el pedido
        if (!isNaN(precio)) {
            tbodyElement.innerHTML += `
                <div class="producto" data-id="${pedido.id_pedido}">
                    <p>ID Cliente: ${pedido.id_cliente}</p>
                    <p>ID Pedido: ${pedido.id_pedido}</p>
                    <p>Fecha: ${pedido.fecha}</p>
                    <p>Método: ${pedido.metodo}</p>
                    <p>Cantidad Total: ${pedido.cantidad_total}</p>
                    <p>Precio Total: ${precio.toFixed(2)} €</p>
                    <p>Número de Dirección: ${pedido.num_dir}</p>
                    <p>Calle: ${pedido.calle_dir}</p>
                    <p>Código Postal: ${pedido.codigo_postal}</p>

                    <label> Estado: </label>
                    <select class="estado-pedido" data-id="${pedido.id_pedido}" required>
                        <option value="Enviado">Enviado</option>
                        <option value="En camino">En camino</option>
                        <option value="Entregado">Entregado</option>
                    </select>

                    <a>
                        <img src="../../../backend/IMG/info icon.png" alt="Información" height="55px">
                    </a>

                    <button class="aceptar" data-id="${pedido.id_pedido}">Aceptar</button>
                </div>  
            `;
        } else {
            console.error(`Precio inválido para el pedido ${pedido.id_pedido}`);
        }
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