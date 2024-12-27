<?php
// Se establece la conexión con la base de datos "listado" usando las credenciales de usuario "root" sin contraseña.
// Si no se puede conectar, se detiene el script y se muestra un mensaje de error.
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Diseño adaptable -->
    <title>Eliminar Familiar</title> <!-- Título del documento -->

    <style>
        /* Selector universal */
        * {
            margin: 0;
            padding: 0;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        /* Estilo para el cuerpo */
        body {
            background-image: url('fondo.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
            text-align: center;
        }

        /* Estilo para el título principal */
        h1 {
            margin-top: 20px;
            font-size: 45px;
            color: #fff;
            text-shadow: 2px 2px 5px #000;
        }

        /* Estilo para la tarjeta */
        .card, .message-card {
            background: rgba(31, 97, 141, 0.8);
            color: #fff;
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 4px solid #467ea2;
            border-radius: 15px;
            box-shadow: 5px 5px 65px #467ea2;
            text-align: left;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .message-card {
            background: rgba(0, 128, 0, 0.8); /* Fondo verde semi-transparente */
            border-color: #27ae60;
            text-align: center;
        }

        /* Estilo general para los botones */
        .btn {
            width: 200px;
            padding: 10px;
            background: #236590;
            border: 3px solid #fff;
            color: #fff;
            border-radius: 15px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #184563;
            border-color: #184563;
            font-size: 20px;
            color: aliceblue;
        }

        /* Botón de confirmación específico */
        .btn-confirmar {
            margin-top: 20px;
            background: #d9534f; /* Color rojo para eliminar */
            border-color: #c9302c;
        }

        .btn-confirmar:hover {
            background: #c9302c; /* Color rojo más oscuro en hover */
            border-color: #ac2925;
        }
    </style>
</head>
<body>
    <?php
    // Verifica si el formulario se envió mediante el método POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"]; // Obtiene el ID del familiar desde el formulario

        // Comprueba si se confirmó la eliminación
        if (isset($_POST["confirmar"])) {
            // Consulta para obtener el nombre del familiar antes de eliminarlo
            $consultaNombre = "SELECT nombre FROM familia WHERE id = $id";
            $resultadoNombre = mysqli_query($conexion, $consultaNombre);
            $nombre = mysqli_fetch_assoc($resultadoNombre)["nombre"]; // Extrae el nombre del registro

            // Consulta para eliminar el familiar con el ID dado
            $consultaEliminar = "DELETE FROM familia WHERE id = $id";

            if (mysqli_query($conexion, $consultaEliminar)) {
                // Si la eliminación fue exitosa, muestra un mensaje de confirmación
                echo "<div class='message-card'>";
                echo "<h2>Registro Eliminado</h2>";
                echo "<p>El familiar <strong>$nombre</strong> ha sido eliminado con éxito.</p>";
                echo "</div>";
                echo "<a href='registro.php' class='btn'>Volver</a>";
            } else {
                // Si ocurre un error al eliminar, muestra un mensaje de error
                echo "<div class='message-card' style='background: rgba(255, 0, 0, 0.8); border-color: #b71c1c;'>";
                echo "<h2>Error</h2>";
                echo "<p>Error al eliminar el registro: " . mysqli_error($conexion) . "</p>";
                echo "</div>";
            }
        } else {
            // Si no se confirmó, busca el registro del familiar
            $consulta = "SELECT * FROM familia WHERE id = $id";
            $resultado = mysqli_query($conexion, $consulta);

            if ($fila = mysqli_fetch_assoc($resultado)) {
                // Si se encuentra el registro, muestra los datos del familiar
                echo "<h1>Familiar Encontrado</h1>";
                echo "<div class='card'>";
                echo "<p><strong>ID:</strong> " . $fila["id"] . "</p>";
                echo "<p><strong>Nombre:</strong> " . $fila["nombre"] . "</p>";
                echo "<p><strong>Parentesco:</strong> " . $fila["parentesco"] . "</p>";

                // Muestra la imagen asociada al familiar
                $rutaImagen = "imagenes/" . basename($fila["foto"]);
                echo "<p><strong>Foto:</strong><br> <img src='" . $rutaImagen . "' alt='Foto' style='max-width: 100%; border-radius: 10px;'></p>";
                echo "</div>";

                // Formulario para confirmar la eliminación del familiar
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id' value='" . $fila["id"] . "'>";
                echo "<button type='submit' name='confirmar' class='btn btn-confirmar'>Confirmar Eliminación</button>";
                echo "</form>";
            } else {
                // Si no se encuentra el ID, muestra un mensaje indicando que no hay resultados
                echo "<div class='card'>";
                echo "<p>No se encontró ningún familiar con el ID proporcionado.</p>";
                echo "<a href='registro.php' class='btn'>Volver</a>";
                echo "</div>";
            }
        }
    } else {
        // Si el método de solicitud no es POST, muestra un mensaje de error
        echo "Método no permitido.";
    }

    // Cierra la conexión con la base de datos
    mysqli_close($conexion);
    ?>
</body>
</html>

