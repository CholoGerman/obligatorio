window.onload =()=> {
      
    mostrarPedido(pedido);
    mostrarPedidos(pedido);
}


 class PedidoDao{

    async  obtenerPedido(id_pedido){
    let url ="http://localhost/obligatorio/backend/controlador/PedidosController.php?funcion=obtener";
    let formData = new FormData();
    formData.append("id_pedido",id_pedido);
    let config = {
        method:"POST",
        body:formData
    }
    let respuesta = await fetch(url,config);
    let pedido = await respuesta.json();
    return pedido;


}
async obtenerPedidos() {
    let url = "http://localhost/obligatorio/backend/controlador/PedidosController.php?funcion=obtenerall";
    let respuesta = await fetch(url);
    let pedidos = await respuesta.json();
    console.log("Pedidos recibidos:", pedidos);  // Verifica los datos recibidos
    return pedidos;
}




async obtenerPedidosCliente(id_cliente) {
    let url = `http://localhost/obligatorio/backend/controlador/PedidosController.php?funcion=obtenerCliente&id_cliente=${id_cliente}`;
    let config = {
        method: "GET",  // Cambiado a GET
    };

    try {
        let respuesta = await fetch(url, config);
        let pedido = await respuesta.json();
        console.log("Respuesta de la API:", pedido); // Verifica la respuesta
        return pedido;
    } catch (error) {
        console.error("Error al obtener los pedidos:", error);
        return [];
    }
}




async cambiarEstadoPedido(id_pedido, estado) {
    $origen = getOrigin();
    let url = $origen + "/backend/controlador/PedidosController.php?funcion=estado";
    let formData = new FormData();
    formData.append("estado", estado);  
    formData.append("id_pedido", id_pedido);  

    let config = {
        method: "POST",
        body: formData
    };

    try {
        let respuesta = await fetch(url, config);
        let textoRespuesta = await respuesta.text();
        let respuestaJson = JSON.parse(textoRespuesta);
        if (respuestaJson.status) {
            alert(respuestaJson.mensaje);
        } else {
            alert("Error: " + respuestaJson.mensaje);
        }
    } catch (error) {
        console.error("Error en la solicitud o parseo de JSON:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
}




    
}




export default PedidoDao;
