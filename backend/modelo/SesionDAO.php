    <?php
    require_once "../conexion/conexion.php";
    require_once '../modelo/Repuesta.php';

    //Inica una session solo si no hay una ya activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //metoodos para gestionar las sesiones
    class SesionDao {

        // Método para registrar un nuevo usuario
        function register($correo, $contraseña, $nombre, $apellido, $codigo_postal = null, $calle_dir = null, $num_dir = null) {
            $connection = connection();

            // Validar si el correo ya está registrado
            $sqlCheck = "SELECT * FROM persona WHERE correo = ?";

            $stmt = $connection->prepare($sqlCheck);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultadoCheck = $stmt->get_result();            
            if ($resultadoCheck && $resultadoCheck->num_rows > 0) {
                return new Respuesta(false, "El correo ya está registrado.", null);
            }
            
            // Hashea la contraseña
            $hash = password_hash($contraseña, PASSWORD_BCRYPT);
            
            // Consulta SQL para insertar la nueva persona
            $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES (?, ?, ?, ?)";

            // Ejecuta la consulta
            $stmt = $connection->prepare($sqlPersona);
            $stmt->bind_param("ssss", $correo, $hash, $nombre, $apellido);
            
            // Ejecuta la consulta
            if (!$stmt->execute()) {
                error_log("Error al agregar la persona: " . $connection->error);
                return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
            }
            
            // Obtener el ID de la persona recién creada
            $idPersona = $connection->insert_id;
            // Consulta SQL para insertar el cliente asociado a la persona
            $sqlCliente = "INSERT INTO cliente (id_persona, codigo_postal, calle_dir, num_dir) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($sqlCliente);
            $stmt->bind_param("isss", $idPersona, $codigo_postal, $calle_dir, $num_dir);
            
            // Ejecuta la consulta para el cliente
            if (!$stmt->execute()) {
                return new Respuesta(false, "Error al agregar el cliente: " . $connection->error, null);
            }
        
            // Retorna una respuesta exitosa
            return new Respuesta(true, "Usuario y cliente registrados correctamente", null);
        }
        
        // Método para registrar un administrador
        function registerAdmin($correo, $contraseña, $nombre, $apellido) {

            // Hashea la contraseña
            $hash = password_hash($contraseña, PASSWORD_BCRYPT);

            //Conexion con la base de datos
            $connection = connection();
        
            // Inserta en la tabla persona
            $sqlPersona = "INSERT INTO persona (correo, contraseña, nombre, apellido) VALUES (?, ?, ?, ?)";

            // Ejecuta la consulta
            $stmt = $connection->prepare($sqlPersona);
            $stmt->bind_param("ssss", $correo, $hash, $nombre, $apellido);
        
            if (!$stmt->execute()) {
                return new Respuesta(false, "Error al agregar el usuario: " . $connection->error, null);
            }
        
            $id_persona = $connection->insert_id; // Obtiene el ID de la persona recién agregada
        
            // Inserta en la tabla admin
            $sqlAdmin = "INSERT INTO admin (id_persona) VALUES (?)";
            $stmt = $connection->prepare($sqlAdmin);
            $stmt->bind_param("i", $id_persona);
        
            if (!$stmt->execute()) {
                return new Respuesta(false, "Error al agregar el administrador: " . $connection->error, null);
            }
        
            return new Respuesta(true, "Administrador registrado correctamente", null);
        }

        // Método para obtener el ID del cliente asociado a una persona
        public function getIdCliente($id_persona) {
            $sql = "SELECT id_cliente FROM cliente WHERE id_persona = $id_persona";
            $connection = connection();

            $resultado = $connection->query($sql);
            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc()['id_cliente'];
            }
            return null; // O manejar el caso donde no se encuentre el cliente
        }
        
        
        // Método para iniciar sesión
        // public function login($correo, $contraseña) {
        //     $connection = connection();
        //     $sql = "SELECT * FROM persona WHERE correo=?";
        //     $stmt = $connection->prepare($sql);
        //     $stmt->bind_param("s", $correo);
        //     $stmt->execute();
        //     $respuesta = $stmt->get_result();
        
        //     if ($respuesta) {
        //         $usuario = $respuesta->fetch_assoc();
        //         if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        //             // Iniciar sesión y guardar datos del usuario
        //             $_SESSION["session"] = [
        //                 "id_persona" => $usuario['id_persona'],
        //                 "correo" => $usuario['correo'],
        //                 "nombre" => $usuario['nombre'],
        //                 "apellido" => $usuario['apellido']
        //             ];
                    
        
        //             return new Respuesta(true, "Inicio de sesión exitoso", $usuario);
        //         } else {
        //             return new Respuesta(false, "Correo o contraseña incorrectos", null);
        //         }
        //     } else {
        //         error_log("Error en consulta de login: " . $connection->error);
        //         return new Respuesta(false, "Error en la consulta", null);
        //     }
        // }
        

        public function login($correo, $contraseña) {
            $connection = connection();
            
            // Consulta para obtener los datos de la persona y el id_cliente asociado
            $sql = "SELECT persona.*, cliente.id_cliente 
                    FROM persona 
                    LEFT JOIN cliente ON persona.id_persona = cliente.id_persona 
                    WHERE persona.correo=?";
            
            // Ejecuta la consulta para obtener los datos y el id_cliente asociado
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $respuesta = $stmt->get_result();
        
            // Valida si se obtuvieron datos
            if ($respuesta) {

                // Obtiene los datos de la persona y el id_cliente asociado
                $usuario = $respuesta->fetch_assoc();
                
                // Valida si la contraseña coincide con la hash guardada en la base de datos
                if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
                    // Iniciar sesión y guardar datos del usuario
                    $_SESSION["session"] = [
                        "id_persona" => $usuario['id_persona'],
                        "correo" => $usuario['correo'],
                        "nombre" => $usuario['nombre'],
                        "apellido" => $usuario['apellido']
                    ];
                    
                    // Agregar id_cliente a la respuesta si existe
                    $usuario['id_cliente'] = $usuario['id_cliente'] ?? null;
        
                    return new Respuesta(true, "Inicio de sesión exitoso", $usuario);

                    // error_log("ID Cliente obtenido en login: " . ($usuario['id_cliente'] ?? 'null'));

                } else {
                    return new Respuesta(false, "Correo o contraseña incorrectos", null);
                }
            } else {
                error_log("Error en consulta de login: " . $connection->error);
                return new Respuesta(false, "Error en la consulta", null);
            }
        }
        
        // Método para cerrar sesión
        function logOut() {
            // Destruye la sesión
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
                return new Respuesta(true, "Sesión cerrada correctamente", null);
            }
            return new Respuesta(false, "No hay sesión activa", null);
        }
    }
