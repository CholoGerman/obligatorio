window.onload = () => {
    let carrito = new carritoDao();
    carrito.agregarProducto();
    mostrarCarrito(productos);

    let agregar = new agregarDao();
    agregar.agregarAlCarrito();
    agregarAlCarrito()
}

class CarritoDao {


    async realizarCompra(datos) {
        const response = await fetch("http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(datos)
        });

        return response;
    }





    
    async agregarDetalle(id_pedido) {

        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=factura";
        let formData = new FormData();
        formData.append("id_pedido", id_pedido);
        let config = {
            method: "POST",
            body: formData
        }
        let respuesta = await fetch(url, config);
        if (respuesta.ok) {
            alert("Detalle añadido con exito");
        } else {
            alert("Hubo un error al agregar el detalle");
        }


    }
    async modificarStock(id_repuesto, cantidad) {

        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=stock";
        let formData = new FormData();
        formData.append("id_repuesto", id_repuesto);
        formData.append("cantidad", cantidad);
        formData.append("precio", precio);
        let config = {
            method: "POST",
            body: formData
        }
        let respuesta = await fetch(url, config);
        if (respuesta.ok) {
            alert("Stock modificado con exito");
        } else {
            alert("Hubo un error al modificar el stock");
        }


    }


    async agregarAlCarrito(id_repuesto, precio) {
        let cantidadElement = document.getElementById('cantidad');
        console.log("Elemento Cantidad:", cantidadElement); // Verificar que existe
    
        let cantidad = parseInt(cantidadElement.innerHTML);
        let nombre = sessionStorage.getItem('nombreUsuario');
        let apellido = sessionStorage.getItem('apellidoUsuario');
    
        console.log("Nombre:", nombre, "Apellido:", apellido); // Verificar valores
    
        if (!nombre || !apellido) {
            alert("Debes iniciar sesión para agregar productos al carrito.");
            return;
        }
    
        try {
            let response = await fetch("http://localhost/obligatorio/backend/controlador/CarritoController.php?funcion=comprar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id_repuesto: id_repuesto,
                    cantidad: cantidad,
                    nombre: nombre,
                    apellido: apellido,
                    departamento: departamento,
                    ciudad: ciudad,
                    calle: calle,
                    numero: numero,
                    telefono: telefono
                })
            });
    
            let resultado = await response.json();
            if (resultado.success) {
                alert("Producto agregado al carrito.");
            } else {
                alert("Error al agregar el producto al carrito: " + resultado.message);
            }
        } catch (error) {
            console.error("Error al agregar al carrito:", error);
            alert("Error al agregar el producto al carrito.");
        }
    }
    
    
}


export default CarritoDao;