<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Especifica la codificación de caracteres para admitir caracteres especiales como acentos -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajusta la escala y el tamaño en dispositivos móviles -->
    <title>Eliminar Familiar</title> <!-- Título de la página que aparece en la pestaña del navegador -->
    <link rel="stylesheet" href="css/estilos1.css"> <!-- Enlace al archivo de estilos CSS para la personalización de diseño -->
</head>
<body>
    <h1>Eliminar Familiar</h1> <!-- Encabezado principal de la página -->

    <!-- Formulario para buscar y eliminar a un familiar -->
    <form action="eliminar_buscar.php" method="post"> <!-- Envía los datos del formulario al archivo eliminar_buscar.php mediante el método POST -->
        <label for="id">Ingrese el ID del familiar:</label> <!-- Etiqueta para el campo de entrada donde se solicita el ID del familiar -->
        <input type="number" id="id" name="id" required> <!-- Campo de entrada para el ID. Es obligatorio y solo acepta números -->
        <br><br>

        <button type="submit">Previsualizar</button> <!-- Botón para enviar el formulario -->
    </form>
</body>
</html>
