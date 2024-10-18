import carritoDao from "../../DAO/carritoDAO.js"


window.onload = async () => {
        let carrito = await new carritoDao().mostrarCarrito();
        mostrarCarrito(carrito);

    

        

}


function mostrarCarrito(carrito) {
    console.log("a");  
    if (carrito.length === 0) {
        console.log("No se han recibido productos.");
    }
    let tbodyElement = document.querySelector("#divCarrito");
    tbodyElement.innerHTML = "";  

    carrito.forEach((repuesto) => {
        tbodyElement.innerHTML += ` 
     
           <div class="producto">
            <a><img ${repuesto.imagen}" height="90px"></a>
            <h4>${repuesto.nombre}</h4>
            <p>${repuesto.precio}</p>                                                                     <======== ESTE HTML NO ESTA BIEN/ACTUALIZADO
         ¿¿¿   <p>${detalle.cantidad}</p> ???
            <a><img src="../../BACKEND/IMG/icon_eliminar.png" height="50px"></a>
            <a href="detalle_Producto.html"><img src="../../BACKEND/IMG/info icon.png" height="55px"></a> 
        </div>


   
 `;
    });

    // Añadir el evento click a los enlaces
    let link = document.querySelectorAll('.producto-link');
    link.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); 
            let id = this.dataset.id; 
            window.open(`detalle_Producto.html?id_repuesto=${repuesto.id}`, '_blank'); 
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









