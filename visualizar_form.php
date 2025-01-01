<!DOCTYPE html>
<html>
<head>
    <title>Familiares Registrados</title>
    <style>
        /* Estilos generales para la página */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color:rgb(77, 127, 160); /* Color de fondo */
        }

        /* Estilos para el título principal */
        h1 {
            text-align: center; /* Centra el título */
            font-size: 2.5em; /* Tamaño de fuente */
            color:rgb(242, 244, 245); /* Color azul para el título */
            margin-bottom: 20px; /* Margen inferior */
            text-shadow: 2px 2px 5px rgba(231, 223, 223, 0.1); /* Sombra suave al texto */
        }

        /* Estilos para el contenedor de tarjetas */
        .contenedor-tarjetas {
            display: flex; /* Usamos flexbox para un diseño flexible */
            flex-wrap: wrap; /* Las tarjetas se ajustarán al tamaño de la pantalla */
            gap: 20px; /* Espacio entre las tarjetas */
            justify-content: center; /* Alinea las tarjetas al centro */
        }

        /* Estilos para cada tarjeta */
        .tarjeta {
            border: 1px solid #ccc; /* Borde de la tarjeta */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            width: 220px; /* Ancho de la tarjeta */
            text-align: center; /* Centra el contenido dentro de la tarjeta */
            padding: 15px; /* Espaciado interior */
            background-color: #ffffff; /* Color de fondo blanco */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transición para efectos de hover */
        }

        /* Efecto cuando se pasa el ratón sobre la tarjeta */
        .tarjeta:hover {
            transform: translateY(-10px); /* Mueve la tarjeta hacia arriba */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Aumenta la sombra para dar un efecto de elevación */
        }

        /* Estilos para las imágenes dentro de las tarjetas */
        .tarjeta img {
            border-radius: 10px; /* Bordes redondeados en la imagen */
            width: 180px; /* Tamaño de la imagen */
            height: 180px; /* Tamaño de la imagen */
            object-fit: cover; /* Asegura que la imagen no se deforme */
            margin-bottom: 10px; /* Espacio inferior */
        }

        /* Estilos para el nombre del familiar dentro de la tarjeta */
        .tarjeta h3 {
            margin: 10px 0; /* Margen arriba y abajo */
            font-size: 1.3em; /* Tamaño de fuente */
            color: #236590; /* Color azul para el nombre */
            font-weight: bold; /* Negrita */
        }

        /* Estilos para la descripción del parentesco */
        .tarjeta p {
            margin: 5px 0; /* Margen arriba y abajo */
            color: #555; /* Color gris para el texto */
            font-size: 1em; /* Tamaño de fuente */
        }

        /* Estilos para el ID del familiar */
        .tarjeta .id {
            margin: 5px 0; /* Margen arriba y abajo */
            font-size: 0.9em; /* Tamaño de fuente más pequeño */
            color: #777; /* Color gris claro */
        }

        /* Estilos para el botón dentro de la tarjeta */
        .tarjeta .button {
            display: inline-block; /* Botón como elemento en línea */
            padding: 8px 15px; /* Espaciado interior */
            margin-top: 10px; /* Margen superior */
            background-color: #236590; /* Color de fondo azul */
            color: #fff; /* Color del texto blanco */
            border-radius: 5px; /* Bordes redondeados */
            text-decoration: none; /* Elimina el subrayado del enlace */
            font-weight: bold; /* Negrita */
            transition: background-color 0.3s ease; /* Transición para el cambio de color */
        }

        /* Efecto cuando se pasa el ratón sobre el botón */
        .tarjeta .button:hover {
            background-color: #184563; /* Cambia el color de fondo a un azul más oscuro */
        }

        /* Estilos cuando no hay familiares registrados */
        .no-familiares {
            text-align: center; /* Centra el mensaje */
            font-size: 1.2em; /* Tamaño de fuente */
            color: #236590; /* Color azul para el texto */
        }
    </style>
</head>
<body>
    <!-- Título principal de la página -->
    <h1>Familiares Registrados</h1>

    <!-- Contenedor que envolverá las tarjetas -->
    <div class="contenedor-tarjetas">
        <?php
        // Incluir el archivo PHP que contiene los datos de los familiares
        include 'visualizar.php';

        // Comprobar si la variable $familiares contiene datos
        if (!empty($familiares)) {
            // Si hay familiares, recorrer el array de familiares
            foreach ($familiares as $familiar) {
                // Crear la ruta completa de la imagen usando el nombre de la foto
                $imagen = "imagenes/" . basename($familiar["foto"]);
                
                // Mostrar la tarjeta para cada familiar
                echo "
                <div class='tarjeta'>
                    <img src='$imagen' alt='Foto de {$familiar["nombre"]}'> <!-- Foto del familiar -->
                    <p class='id'>ID: {$familiar["id"]}</p> <!-- ID del familiar -->
                    <h3>{$familiar["nombre"]}</h3> <!-- Nombre del familiar -->
                    <p>{$familiar["parentesco"]}</p> <!-- Parentesco -->
                   
                </div>";
            }
        } else {
            // Si no hay familiares registrados, mostrar un mensaje
            echo "<p class='no-familiares'>No hay familiares registrados.</p>";
        }
        ?>
    </div>
</body>
</html>
