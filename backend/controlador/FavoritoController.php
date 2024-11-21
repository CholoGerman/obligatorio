<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

require_once "../modelo/FavoritoDAO.php";

// Función para agregar un producto a favoritos
function agregarFavorito() {
    // Depurar: ver si los datos están llegando
    if (isset($_POST['id_repuesto']) && isset($_POST['id_persona'])) {
        $id_repuesto = $_POST['id_repuesto']; // Producto al que se agrega el favorito
        $id_persona = $_POST['id_persona'];  // id_persona de la sesión del usuario

        // Validamos que se haya recibido correctamente el id_repuesto y id_persona
        if (empty($id_repuesto) || empty($id_persona)) {
            echo json_encode(["status" => false, "message" => "Faltan datos para agregar el favorito."]);
            return;
        }

        // Creamos una instancia del FavoritoDao
        $favoritoDao = new FavoritoDao();
        
        // Obtenemos el id_cliente usando el id_persona
        $id_cliente = $favoritoDao->obtenerIdCliente($id_persona);

        if ($id_cliente !== null) {
            // Si encontramos un cliente, agregamos el favorito
            $resultado = $favoritoDao->agregarFavorito($id_cliente, $id_repuesto);

            // Respondemos si se pudo agregar o hubo un error
            if ($resultado) {
                echo json_encode(["status" => true, "message" => "Producto agregado a favoritos."]);
            } else {
                echo json_encode(["status" => false, "message" => "Error al agregar producto a favoritos."]);
            }
        } else {
            // Si no encontramos un cliente, respondemos que el cliente no existe
            echo json_encode(["status" => false, "message" => "Cliente no encontrado."]);
        }
    } else {
        // Si faltan parámetros
        echo json_encode(["status" => false, "message" => "Faltan datos para agregar el favorito."]);
    }
}





// Controlador para manejar las peticiones de favoritos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['funcion']) && $_POST['funcion'] == 'agregar') {
        agregarFavorito();
    }
    
    } else {
        // Si no se recibe una función válida
        echo json_encode(["status" => false, "message" => "Acción no válida."]);
    }

?>
