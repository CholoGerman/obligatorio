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





function cargarDatos(ci, nombre, apellido) {

    document.querySelector("#id").value = ci;
    document.querySelector("#ci").value = ci;
    document.querySelector("#nombre").value = nombre;
    document.querySelector("#apellido").value = apellido;
}




function Listar(usuarios) {

    let tbodyElement = document.querySelector("#cuerpoTablaUsuarios");
    usuarios.forEach((usuario) => {
        tbodyElement.innerHTML += `

<tr>
    <td>${usuario.ci} </td>
    <td>${usuario.nombre}</td>
    <td>${usuario.apellido} </td>
    <td><button onclick="cargarDatos('${usuario.ci}','${usuario.nombre}','${usuario.apellido}')">Modificar</button></td>
</tr>
        `;
    }
);
}