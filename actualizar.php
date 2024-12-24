<?php
// Establecer conexión con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos");

// Verificar si la solicitud es POST y si el formulario de actualización fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar"])) {
    // Obtener los valores enviados desde el formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $parentesco = $_POST["parentesco"];
    $nuevaImagen = $_FILES["foto"]["name"];  // Obtener el nombre de la nueva imagen (si se seleccionó)

    // Verificar si se ha seleccionado una nueva imagen
    if ($nuevaImagen) {
        // Si se seleccionó una imagen nueva, moverla a la carpeta de imágenes
        $rutaDestino = "imagenes/" . basename($nuevaImagen);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $rutaDestino);
        $foto = $nuevaImagen;  // Actualizar el valor de la foto con el nuevo nombre de archivo
    } else {
        // Si no se seleccionó una nueva imagen, mantener la imagen anterior
        $foto = $_POST["foto_actual"];
    }

    // Crear la consulta SQL para actualizar los datos del familiar en la base de datos
    $consultaActualizar = "UPDATE familia SET nombre = '$nombre', parentesco = '$parentesco', foto = '$foto' WHERE id = $id";

    // Ejecutar la consulta de actualización
    if (mysqli_query($conexion, $consultaActualizar)) {
        // Si la actualización fue exitosa, mostrar un mensaje de éxito
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Actualización Exitosa</title>
            <style>
                /* Estilos para la página de éxito */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f9;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                .card {
                    background: #e0f7fa;
                    border: 2px solid #00897b;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    max-width: 400px;
                    width: 100%;
                }

                .card h2 {
                    margin: 0;
                    font-size: 1.5em;
                    color: #00695c;
                }

                .card p {
                    font-size: 1em;
                    color: #004d40;
                }

                .card a {
                    display: inline-block;
                    margin-top: 15px;
                    padding: 10px 15px;
                    background-color: #004d40;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 0.9em;
                }

                .card a:hover {
                    background-color: #00796b;
                }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>¡Actualización Exitosa!</h2>
                <p>Los cambios se han guardado con éxito.</p>
                <a href='registro.php'>Volver</a>
            </div>
        </body>
        </html>";
    } else {
        // Si hubo un error al actualizar, mostrar el mensaje de error
        echo "<p style='color:red;'>Error al actualizar los datos: " . mysqli_error($conexion) . "</p>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
