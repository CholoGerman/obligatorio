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



function Listar(usuarios) {
    let tbodyElement = document.querySelector("#cuerpoTablaUsuarios");
    usuarios.forEach((usuario) => {
        tbodyElement.innerHTML += `

<tr>
    <td>${usuario.ci} </td>
    <td>${usuario.nombre}</td>
    <td>${usuario.apellido} </td>
</tr>
    `;
    }
    )
}


