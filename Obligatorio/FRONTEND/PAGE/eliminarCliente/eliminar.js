window.onload = () => {
    obtenerUsuarios();
}
async function obtenerUsuarios() {
    let url = "../../../BACKEND/controlador/usuario.php?funcion=obtener";
    let respuesta = await fetch(url);
    let datos = await respuesta.json()
    console.log(datos);
    Listar(datos)
}





async function eliminarUsuario(ci) {
    let formData = new FormData();
    formData.append("ci", ci);
    let url = "../../../BACKEND/controlador/usuario.php?funcion=eliminar";
    let config ={
        method:"POST",
        body:formData
        }
    let respuesta = await fetch(url,config);
    let datos = await respuesta.json()
    console.log(datos);
    alert(ci);
}


function Listar(usuarios) {

    let tbodyElement = document.querySelector("#cuerpoTablaUsuarios");
    usuarios.forEach((usuario) => {
        tbodyElement.innerHTML += `

<tr>
    <td>${usuario.ci} </td>
    <td>${usuario.nombre}</td>
    <td>${usuario.apellido} </td>
    <td><button onclick="eliminarUsuario(${usuario.ci})">Eliminar</button></td>
</tr>
    `;
    }
    )
}

