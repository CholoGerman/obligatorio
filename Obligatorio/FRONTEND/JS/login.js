window.onload = () => {

    let formElement = document.querySelector("#form");
    console.log("a", formElement);
    formElement.onsubmit = async (e) => {

        e.preventDefault();
        let formFormData = new FormData(formElement);
        let url = "http://localhost/proyecto/Backend/controlador/usuario_controlador.php?funcion=obtener";

        let config = {
            method: 'POST',
            body: formFormData

        }

        let respuesta = await fetch(url, config);
        let datos = await respuesta.json()
        console.log(datos);

        if (datos.length > 0) {
            alert("Usuario correcto")
        }

        else {
            alert("Usuario o contraseña incorrectos")
        }
    }
}