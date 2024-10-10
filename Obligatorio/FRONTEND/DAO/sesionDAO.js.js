Window.onload = () => {

}


export default class SesionController{

     async register(correo,password,usuario){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/SesionController.php?funcion=register";
        let formData = new FormData();
        formData.append("usuario",usuario);
        formData.append("correo",correo);
        formData.append("password",password);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let respuestaJson = await respuesta.json();
        if(respuestaJson.success){
            alert("Usuario registrado correctamente");
        }else{
            alert(respuestaJson.message);
        }

    }
    
    
    async login(correo,password){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/SesionController.php?funcion=login";
        let formData = new FormData();
        formData.append("correo",correo);
        formData.append("password",password);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);
        let respuestaJson = await respuesta.json();
        if(respuestaJson.success){
            alert("Bienvenido " + respuestaJson.usuario);
        }else{
            alert(respuestaJson.message);
        }

    }
    
    
    
     async logOut(){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/SesionController.php?funcion=logOut";
        let respuesta = await fetch(url);
        let respuestaJson = await respuesta.json();
        if(respuestaJson.success){
            alert("Sesión cerrada correctamente");
        } else{
            alert(respuestaJson.message);
        }
    
        
    }



}
