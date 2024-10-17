import ProductoDao from "../../DAO/productoDAO.js";

window.onload = async () => {
        let catalogo = await new ProductoDao().obtenerCatalogo();
        mostrarCatalogo(catalogo);

    

        

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
    console.log("Catálogo recibido:");  
    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
    }
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";  

    catalogo.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
            <div class="contenedor_producto2">                                                      
          <a href="../producto/detalle_producto.html?id=${repuesto.id}" class="producto-link"><img src="${repuesto.imagen}"></a>

                <div class="detalles">
                    <p>${repuesto.nombre}</p>
                    <p>$${repuesto.precio}</p>
                </div>
            </div>
        `;
    });

    // Añadir el evento click a los enlaces
    let link = document.querySelectorAll('.producto-link');
    link.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); 
            let id = this.dataset.id; 
            window.open(`detalle_Producto.html?id=${id}`, '_blank'); // Abre la nueva pestaña
        });
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
