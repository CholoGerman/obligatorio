export default class SesionController{

     async register(correo,password){
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/SesionController.php?funcion=register";
        let formData = new FormData();
        formData.append("email",correo);
        formData.append("password",password);
        let config = {
            method:"POST",
            body:formData
        }
        let respuesta = await fetch(url,config);

    }
    
    
    async login(){
    
    
    
    }
    
    
    
     async logOut(){
        let url ="http://localhost/obligatorio/obligatorio-3/Obligatorio/backend/controlador/SesionController.php?funcion=logOut";
        let respuesta = await fetch(url);
    
        
    }



}
