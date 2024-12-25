<?php
// Configuración de conexión a la base de datos
// Se establece la conexión con el servidor MySQL, especificando host, usuario, contraseña y base de datos.
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos");

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID enviado desde el formulario
    $id = $_POST["id"];

    // Buscar el familiar en la base de datos para obtener la ruta de su foto
    $consultaFoto = "SELECT foto FROM familia WHERE id = $id";
    $resultadoFoto = mysqli_query($conexion, $consultaFoto);

    // Verificar si se encontró el registro
    if ($fila = mysqli_fetch_assoc($resultadoFoto)) {
        // Guardar la ruta de la foto obtenida
        $rutaFoto = $fila["foto"];

        // Consulta para eliminar el registro del familiar con el ID proporcionado
        $consultaEliminar = "DELETE FROM familia WHERE id = $id";
        if (mysqli_query($conexion, $consultaEliminar)) {
            // Si se eliminó el registro de la base de datos, proceder a eliminar la foto del servidor
            if (file_exists($rutaFoto)) { // Verificar si el archivo existe
                unlink($rutaFoto); // Eliminar el archivo
            }
            // Mostrar mensaje de confirmación en formato HTML
            echo "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Eliminación Exitosa</title>
                <style>
                    /* Estilos del cuerpo */
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

                    /* Estilo de la tarjeta de confirmación */
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

                    /* Título de la tarjeta */
                    .card h2 {
                        margin: 0;
                        font-size: 1.5em;
                        color: #00695c;
                    }

                    /* Texto del mensaje */
                    .card p {
                        font-size: 1em;
                        color: #004d40;
                    }

                    /* Enlace de regreso */
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
                    <h2>¡Eliminación Exitosa!</h2>
                    <p>El familiar ha sido eliminado correctamente.</p>
                    <a href='index.php'>Volver</a>
                </div>
            </body>
            </html>";
        } else {
            // Si ocurre un error al eliminar el registro, mostrar el mensaje de error
            echo "<p style='color:red;'>Error al eliminar el registro: " . mysqli_error($conexion) . "</p>";
        }
    } else {
        // Si no se encontró ningún registro con el ID proporcionado
        echo "<p style='color:red;'>No se encontró ningún familiar con el ID proporcionado.</p>";
    }
} else {
    // Si el método de la solicitud no es POST, mostrar un mensaje de error
    echo "<p style='color:red;'>Método no permitido.</p>";
}

// Cerrar la conexión con la base de datos
mysqli_close($conexion);
?>
