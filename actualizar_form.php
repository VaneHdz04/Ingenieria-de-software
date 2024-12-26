<!DOCTYPE html>
<html>
<head>
    <!-- Título de la página en el navegador -->
    <title>Actualizar Datos</title>

    <!-- Enlace al archivo de hojas de estilo (CSS) para aplicar estilos al formulario y la página -->
    <link rel="stylesheet" href="css/estilos1.css">
</head>
<body>

    <!-- Título principal de la página -->
    <h1>Actualizar Familiar</h1>

    <!-- Formulario para ingresar el ID del familiar -->
    <form action="actualizar_buscar.php" method="post">
        <!-- Etiqueta del campo de entrada del ID -->
        <label for="id">Ingrese el ID del familiar a actualizar:</label>

        <!-- Campo de entrada para el ID del familiar -->
        <input type="number" id="id" name="id" required>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Buscar</button>
    </form>

</body>
</html>
