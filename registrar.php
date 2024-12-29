<?php
// Configuración de la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos"); // Si la conexión falla, se muestra un mensaje de error

// Validación de datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Se obtienen los datos del formulario
    $nombre = $_POST["nombre"];
    $parentesco = $_POST["parentesco"];
    
    // Manejo de la imagen
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) { 
        // Si hay una imagen subida correctamente
        $directorio = "imagenes/"; // Directorio donde se almacenarán las imágenes
        $nombreArchivo = basename($_FILES["foto"]["name"]); // Obtiene el nombre de la imagen
        $rutaArchivo = $directorio . $nombreArchivo; // Ruta completa de la imagen

        // Crear la carpeta si no existe
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true); // Si el directorio no existe, lo crea con permisos adecuados
        }

        // Mover la imagen al directorio
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaArchivo)) {
            // Si la imagen se movió correctamente, se inserta la información en la base de datos
            $consulta = "INSERT INTO familia (nombre, parentesco, foto) VALUES ('$nombre', '$parentesco', '$rutaArchivo')";
            if (mysqli_query($conexion, $consulta)) { // Ejecuta la consulta SQL
                // Si la inserción es exitosa, muestra un mensaje de éxito
                echo "
                <!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Registro Exitoso</title>
                    <style>
                        /* Estilos para la página de registro exitoso */
                        body {
                            background-color:rgb(51, 124, 101);
                            color: #ffffff;
                            font-family: 'Arial', sans-serif;
                            text-align: center;
                            padding: 50px;
                        }
                        .mensaje {
                            background: rgba(255, 255, 255, 0.1);
                            border: 2px solid #ffffff;
                            border-radius: 10px;
                            padding: 20px;
                            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                            display: inline-block;
                        }
                        .mensaje h1 {
                            font-size: 35px;
                        }
                        .mensaje p {
                            font-size: 20px;
                        }
                        .boton {
                            margin-top: 20px;
                            padding: 10px 20px;
                            background-color: #61bb84;
                            color: white;
                            text-decoration: none;
                            font-size: 18px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }
                        .boton:hover {
                            background-color: #07441b;
                        }
                    </style>
                </head>
                <body>
                    <div class='mensaje'>
                        <h1>Registro exitoso</h1>
                        <p>El registro de $nombre se realizó correctamente.</p>
                        <a href='registro.php' class='boton'>Volver al inicio</a>
                    </div>
                </body>
                </html>";
            } else {
                // Si hay un error al insertar, muestra el mensaje de error
                echo "Error al registrar: " . mysqli_error($conexion);
            }
        } else {
            // Si no se puede mover la imagen, muestra un mensaje de error
            echo "Error al subir la imagen.";
        }
    } else {
        // Si no se selecciona una imagen válida, muestra un mensaje de error
        echo "No se seleccionó ninguna imagen válida.";
    }
} else {
    // Si el método de solicitud no es POST, muestra un mensaje de error
    echo "Método no permitido.";
}

// Cerrar la conexión
mysqli_close($conexion); // Cierra la conexión a la base de datos
?>
