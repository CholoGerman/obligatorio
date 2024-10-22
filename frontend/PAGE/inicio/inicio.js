import SesionDao from '../../../frontend/DAO/sesionDAO.js';
import ProductoDao from '../../../frontend/DAO/productoDAO.js'; 


window.onload = async () => {
        let catalogo = await new ProductoDao().obtenerCatalogo();
        mostrarCatalogo(catalogo);

    
       // Agregar el evento al botón de cerrar sesión
       document.getElementById('logoutButton').addEventListener('click', async () => {
        let sesionDao = new SesionDao();
        await sesionDao.logOut(); // Llama a la función de cierre de sesión
});

        

}


let menuToggle = document.getElementById('menuToggle');
let dropdownMenu = document.getElementById('dropdownMenu');

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
    console.log("Catálogo recibido:", catalogo);  
    if (catalogo.length === 0) {
        console.log("No se han recibido productos.");
    }
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";  

    catalogo.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
            <div class="contenedor_producto2"  data-nombre="${repuesto.nombre.toLowerCase()}" >                                                      
          <a href="../producto/detalle_Producto.html?id_repuesto=${repuesto.id_repuesto}"><img src="${repuesto.imagen}"></a>

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


document.getElementById('searchInput').addEventListener('input', filtrarProductos);

function filtrarProductos() {
    let searchInput = document.getElementById('searchInput').value.toLowerCase();
    let productos = document.querySelectorAll('.contenedor_producto2');

    productos.forEach(producto => {
        let nombre = producto.getAttribute('data-nombre');
        producto.style.display = nombre.includes(searchInput) ? 'block' : 'none';
    });
}



document.getElementById('searchInput').addEventListener('input', function() {
    let carousel = document.getElementById('carousel');
    if (this.value) {
        carousel.style.display = 'none';
    } else {
        carousel.style.display = 'flex'; // Cambia a 'flex' para asegurarte de que se mantenga el estilo
        carousel.style.margin = '45px auto'; // Asegúrate de que el margen esté centrado
    }
});
