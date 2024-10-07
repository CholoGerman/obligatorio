<?php
require_once "../modelo/FavoritoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) { // Le asignamos una funcion a cada posible variable de "funcion"
    case "agregar":
        agregarFavorito();
        break;
    case "eliminar":
        eliminarFavorito();
        break;
    case "obtener":
        obtenerFavoritos();
        break;
}

function agregarFavorito(){  //Funcion para agregar un producto a favorito
    $correo = $_POST["correo"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->agregarFavorito($correo, $id_repuesto);
    echo json_encode($resultado);


}


function eliminarFavorito(){  //Funcion para eliminar un producto de favorito
    $correo = $_POST["correo"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->eliminarFavorito($correo, $id_repuesto);
    echo json_encode($resultado);


}

function obtenerFavoritos(){ //Funcion para mostrar los favoritos
    $correo = $_POST["correo"];
    $resultado = (new FavoritoDao())->obtenerFavoritos($correo);
    echo json_encode($resultado);
 }


    
