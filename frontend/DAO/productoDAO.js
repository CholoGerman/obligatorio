window.onload = async () => {


}

class ProductoDao {




    async obtenerProducto(id_repuesto) {

        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.phpfuncion=obtener";
        let formData = new FormData();
        formData.append("id_repuesto", id_repuesto);
        let config = {
            method: "POST",
            body: formData
        }
        let respuesta = await fetch(url, config);
        let producto = await respuesta.json();
        return producto;


    }


    async obtenerCatalogo() {
        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtenerall";

        let respuesta = await fetch(url);
        let productos = await respuesta.json();
        console.log(productos);
        return productos;

    }


    async agregarProducto() {
        let formElement = document.querySelector("#agregarProductoForm");
        formElement.onsubmit = async (e) => {
            e.preventDefault(); // Prevenir el envío del formulario
    
            let formFormData = new FormData(formElement);
            let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
    
            let config = {
                method: "POST",
                body: formFormData
            };
    
            try {
                let respuesta = await fetch(url, config);
                let repuestos = await respuesta.json();
    
             
                alert(repuestos.mensaje);
    
               
                formElement.reset();
            } catch (error) {
                console.error("Error al agregar el producto:", error);
            }
        };
    }
    
     
        
    
    async eliminarProducto(){
            let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=eliminar";
            let formData = new FormData();
            formData.append("id_repuesto", id_repuesto);

            let config = {
                method: "POST",
                body: formData
            }
            let respuesta = await fetch(url, config);
            let producto = await respuesta.json();
            return producto;


        }


    }
    


export default ProductoDao;