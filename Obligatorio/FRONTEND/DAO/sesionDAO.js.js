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

    }
    
    
    async login(){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/SesionController.php?funcion=login";
        let formData = new FormData();
        formData.append("correo",correo);
        formData.append("password",password);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);

    }
    
    
    
     async logOut(){
        let url ="http://localhost/obligatorio/Obligatorio/backend/controlador/SesionController.php?funcion=logOut";
        let respuesta = await fetch(url);
    
        
    }



}
