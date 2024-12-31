<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "listado") 
    or die("Error al conectar con la base de datos");

// Consulta para obtener los registros de la tabla familia en orden ascendente por el id
$consulta = "SELECT * FROM familia ORDER BY id ASC"; // ASC para orden ascendente
$resultado = mysqli_query($conexion, $consulta);

// Crear un array para almacenar los resultados
$familiares = [];
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $familiares[] = $fila;
    }
}

// Cerrar la conexión
mysqli_close($conexion);

// Retornar los datos al archivo HTML
?>
