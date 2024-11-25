<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php
    // Mostramos ls numeros de dias del 1 a la fecha actual
    $dia = date("d");
    $inicio = 1;
    while ($inicio <= $dia){
        echo $inicio."<br>";
        $inicio++;
    }
    ?>

</body>
</html>