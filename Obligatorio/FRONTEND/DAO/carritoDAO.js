export default class CarritoController {


    async realizarCompra() {
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/CarritoController.php?funcion=comprar";
        let respuesta = await fetch(url);
    

    }

}