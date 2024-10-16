import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async () => {
        let catalogo = await new ProductoDao().obtenerCatalogo();
        mostrarCatalogo(catalogo);
        // let producto = await new ProductoDao().obtenerProducto();
        // mostrarProducto(producto);
 
        

}

const menuToggle = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');

menuToggle.addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace recargue la página
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Cierra el menú si se hace clic fuera de él
document.addEventListener('click', function(event) {
    if (!menuToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
    }
});

function mostrarCatalogo(catalogo) {
    console.log("Catálogo recibido:", catalogo);  // Agregar más detalles para depurar
    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
    }
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";  // Limpiar cualquier contenido previo
    catalogo.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
            <div class="contenedor_producto2">                                                      
                <a href="../PAGE/detalle_Producto.html"><img src="${repuesto.imagen}"></a> 
                <div class="detalles">
                    <p>${repuesto.nombre}</p>
                    <p>$${repuesto.precio}</p>
                </div>
            </div>
        `;
    });
}




let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 7000); // Change image every 2 seconds
} 
