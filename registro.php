<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta tags para la codificación de caracteres y la compatibilidad con dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Familiar</title>
    <!-- Enlace al archivo de estilos CSS -->
    <link rel="stylesheet" href="css/estilos1.css">
</head>
<body>
    <!-- Título principal de la página -->
    <h1>Registro Familiar</h1>
    
    <!-- Formulario para registrar la información del familiar -->
    <form action="registrar.php" method="post" enctype="multipart/form-data">
        <!-- Campo para ingresar el nombre del familiar -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <!-- Campo para ingresar el parentesco con el familiar -->
        <label for="parentesco">Parentesco:</label>
        <input type="text" id="parentesco" name="parentesco" required><br><br>

        <!-- Campo para cargar una foto del familiar -->
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required onchange="previewImage(event)"><br><br>

        <!-- Div para mostrar la previsualización de la imagen -->
        <div class="preview">
            <p>Previsualización:</p>
            <!-- Imagen de previsualización que se mostrará cuando se seleccione una foto -->
            <img id="imagePreview" src="" alt="Previsualización de la imagen" style="display:none;">
        </div>

        <!-- Botones de acción para el formulario -->
        <button type="submit">Registrar</button>
        <button type="button" onclick="window.location.href='eliminar_form.php';">Eliminar</button>
        <button type="button" onclick="window.location.href='actualizar_form.php';">Actualizar</button>
        <button type="button" onclick="window.location.href='visualizar_form.php';">Listado Familiar</button>
    </form>

    <!-- Script para previsualizar la imagen seleccionada -->
    <script>
        // Función que se ejecuta cuando se selecciona una imagen
        function previewImage(event) {
            const file = event.target.files[0]; // Obtiene el primer archivo seleccionado
            const preview = document.getElementById('imagePreview'); // Obtiene el elemento de imagen para la previsualización
            
            if (file) {
                const reader = new FileReader(); // Crea un objeto FileReader para leer el archivo seleccionado

                // Evento que se ejecuta cuando el archivo es leído correctamente
                reader.onload = function(e) {
                    preview.src = e.target.result; // Asigna la imagen leída a la fuente de la previsualización
                    preview.style.display = "block"; // Muestra la imagen de previsualización
                };

                // Lee el archivo como un URL de datos
                reader.readAsDataURL(file); 
            } else {
                preview.src = ""; // Si no hay archivo, se limpia la fuente de la imagen
                preview.style.display = "none"; // Oculta la imagen si no se seleccionó ninguna
            }
        }
    </script>
</body>
</html>
