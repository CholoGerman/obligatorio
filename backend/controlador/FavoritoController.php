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
    $id_cliente = $_POST["id_cliente"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->agregarFavorito($id_cliente, $id_repuesto);
    echo json_encode($resultado);


}


function eliminarFavorito(){  //Funcion para eliminar un producto de favorito
    $id_cliente = $_POST["id_cliente"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->eliminarFavorito($id_cliente, $id_repuesto);
    echo json_encode($resultado);


}

function obtenerFavoritos(){ //Funcion para mostrar los favoritos
    $id_cliente = $_POST["id_cliente"];
    $resultado = (new FavoritoDao())->obtenerFavoritos($id_cliente);
    echo json_encode($resultado);
 }


    
