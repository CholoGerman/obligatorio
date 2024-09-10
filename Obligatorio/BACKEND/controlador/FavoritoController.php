<?php
require_once "../modelo/FavoritoDAO.php";
$funcion = $_GET["funcion"];
switch ($funcion) {
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

function agregarFavorito(){
    $correo = $_POST["correo"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->agregarFavorito($correo, $id_repuesto);
    echo json_encode($resultado);


}


function eliminarFavorito(){
    $correo = $_POST["correo"];
    $id_repuesto = $_POST["id_repuesto"];
    $resultado = (new FavoritoDao())->eliminarFavorito($correo, $id_repuesto);
    echo json_encode($resultado);


}

function obtenerFavoritos(){
    $correo = $_POST["correo"];
    $resultado = (new FavoritoDao())->obtenerFavoritos($correo);
    echo json_encode($resultado);
 }


    
