window.onload = async () => { 
    let agregar = new ProductoDao();
    agregar.agregarProducto(); 
};


class ProductoDao {




    async obtenerProducto(id_repuesto) {
       

        let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=obtener";
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
    
        // Filtrar los productos para incluir solo aquellos con stock mayor a 0
        return productos.filter(producto => producto.stock > 0);
    }
    


    async agregarProducto(){
        let formElement = document.querySelector("#agregarProductoForm");
        formElement.onsubmit = async (e) => {
            e.preventDefault(); 
    
            let formFormData = new FormData(formElement);
            let url = "http://localhost/obligatorio/backend/controlador/ProductosController.php?funcion=agregar";
    
            let config = {
                method: "POST",
                body: formFormData
            };
    
          
                let respuesta = await fetch(url, config);
                let repuestos = await respuesta.json();
                console.log(repuestos);
                alert("Producto agregado correctamente");
                formElement.reset();
        
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