<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos");

// Verificar si la solicitud es POST (cuando el usuario envía el formulario)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID del familiar enviado por el formulario
    $id = $_POST["id"];

    // Realizar una consulta para obtener los datos del familiar con ese ID
    $consulta = "SELECT * FROM familia WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta);

    // Si se encontró el familiar con el ID proporcionado
    if ($fila = mysqli_fetch_assoc($resultado)) {
        // Mostrar el formulario con los datos actuales del familiar
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Actualizar Datos</title>
            <style>
                /* Estilos generales para el cuerpo y el formulario */
                body {
                    background-image: url('fondo.jpg');
                    background-size: cover;
                    background-attachment: fixed;
                    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                    color: #fff;
                    text-align: center;
                }

                h1 {
                    margin-top: 20px;
                    font-size: 45px;
                    text-shadow: 2px 2px 5px #000;
                }

                .card {
                    background: rgba(31, 97, 141, 0.8);
                    color: #fff;
                    width: 400px;
                    margin: 20px auto;
                    padding: 20px;
                    border: 4px solid #467ea2;
                    border-radius: 15px;
                    box-shadow: 5px 5px 65px #467ea2;
                    text-align: left;
                }

                .card label {
                    display: block;
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                .card input[type='text'], 
                .card input[type='file'] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border-radius: 10px;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                }

                .card img {
                    display: block;
                    margin: 10px auto;
                    max-width: 150px;
                    border-radius: 10px;
                }

                .card button {
                    width: 100%;
                    padding: 10px;
                    background: #236590;
                    border: 3px solid #fff;
                    color: #fff;
                    border-radius: 15px;
                    font-size: 18px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .card button:hover {
                    background: #184563;
                    border-color: #184563;
                    font-size: 20px;
                    color: aliceblue;
                }

                /* Estilos para los mensajes de éxito o error */
                .success-card, .error-card {
                    background: #ffebee;
                    border: 2px solid #d32f2f;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    max-width: 400px;
                    width: 100%;
                    margin: 20px auto;
                }

                .success-card h2, .error-card h2 {
                    color: #c62828;
                }

                .success-card p, .error-card p {
                    font-size: 1em;
                    color: #b71c1c;
                }

                .success-card a, .error-card a {
                    display: inline-block;
                    margin-top: 15px;
                    padding: 10px 15px;
                    background-color: #d32f2f;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 0.9em;
                }

                .success-card a:hover, .error-card a:hover {
                    background-color: #c62828;
                }
            </style>
        </head>
        <body>
            <h1>Actualizar Datos</h1>
            <div class='card'>
                <!-- Formulario para actualizar los datos -->
                <form action='actualizar.php' method='post' enctype='multipart/form-data'>
                    <!-- Campo oculto para enviar el ID del familiar -->
                    <input type='hidden' name='id' value='{$fila["id"]}'>

                    <!-- Campo de texto para el nombre -->
                    <label for='nombre'>Nombre:</label>
                    <input type='text' id='nombre' name='nombre' value='{$fila["nombre"]}' required>

                    <!-- Campo de texto para el parentesco -->
                    <label for='parentesco'>Parentesco:</label>
                    <input type='text' id='parentesco' name='parentesco' value='{$fila["parentesco"]}' required>

                    <!-- Muestra la foto actual del familiar -->
                    <label for='foto_actual'>Foto actual:</label>
                    <img id='vista_previa' src='imagenes/" . basename($fila["foto"]) . "' alt='Foto'>

                    <!-- Campo oculto para almacenar la ruta de la foto actual -->
                    <input type='hidden' name='foto_actual' value='{$fila["foto"]}'>

                    <!-- Campo para cambiar la foto (opcional) -->
                    <label for='foto'>Cambiar foto (opcional):</label>
                    <input type='file' id='foto' name='foto' accept='image/*' onchange='mostrarImagen(event)'>

                    <!-- Botón para guardar los cambios -->
                    <button type='submit' name='actualizar'>Guardar Cambios</button>
                </form>
            </div>
        </body>
         <script>
            // Función para mostrar la imagen seleccionada antes de enviarla
            function mostrarImagen(event) {
                var archivo = event.target.files[0];
                var lector = new FileReader();
                lector.onload = function(e) {
                    var vistaPrevia = document.getElementById('vista_previa');
                    vistaPrevia.src = e.target.result;
                };
                lector.readAsDataURL(archivo);
            }
        </script>
        </html>";
    } else {
        // Si no se encuentra un familiar con el ID proporcionado, muestra un mensaje de error
        echo "
        <div class='error-card'>
            <h2>Error</h2>
            <p>No se encontró ningún familiar con el ID proporcionado.</p>
            <a href='registro.php'>Volver</a>
        </div>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
