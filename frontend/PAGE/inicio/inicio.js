import ProductoDAO from "../../DAO/productoDAO.js";

window.onload = async () => {
    try {
        let catalogo = await new ProductoDAO().obtenerCatalogo();
        mostrarCatalogo(catalogo);
    } catch (error) {
        console.error("Error al cargar el catálogo:", error);
    }
};

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
    console.log("aaaa", catalogo);
    let tbodyElement = document.querySelector("#contenedor_producto");
    tbodyElement.innerHTML = "";
    catalogo.forEach((repuesto) => { 
        tbodyElement.innerHTML += ` 
            <div class="contenedor_producto2">                                                      
                <a href="../PAGE/detalle_Producto.html"><img src="${repuesto.imagen}" alt="${repuesto.nombre}"></a> 
                <div class="detalles">
                    <p>${repuesto.nombre}</p>
                    <p>$${repuesto.precio}</p>
                </div>
            </div>
        `;
    });
}

function mostrarProducto(productos) {
    let tbodyElement = document.querySelector("#divProducto");
    tbodyElement.innerHTML = "";
    productos.forEach((producto) => {
        tbodyElement.innerHTML += ` 
            <div class="contenedor_img">
                <a><img src="${producto.imagen}" style="aspect-ratio: auto" alt="${producto.nombre}"></a>
            </div>
            <div class="product-info">
                <div class="primera_fila">
                    <h1 class="product-title">${producto.nombre}</h1>
                    <p class="product-price">${producto.precio}.99</p>
                </div>
                <p class="product-details">Estado: ${producto.estado}</p>
                <p class="product-details">Año: ${producto.año}</p>
                <p class="product-details">Color: ${producto.color}</p>
                <div class="product-buttons">
                    <button>Agregar al carrito</button>
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
