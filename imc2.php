<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
</head>
<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $peso = $_POST['peso'];
        $estatura = $_POST['estatura'];

        if ($estatura > 0) {
            $imc = $peso / ($estatura * $estatura);
            echo "<h2>Tu IMC es: " . number_format($imc, 2) . "</h2>";

            // Clasificación según el IMC
            if ($imc < 18.5) {
                echo "<p>Clasificación: Peso inferior al normal</p>";
            } elseif ($imc >= 18.5 && $imc <= 24.9) {
                echo "<p>Clasificación: Peso normal</p>";
            } elseif ($imc >= 25 && $imc <= 29.9) {
                echo "<p>Clasificación: Sobrepeso</p>";
            } else {
                echo "<p>Clasificación: Obesidad</p>";
            }
        } else {
            echo "<p>La estatura debe ser mayor a 0.</p>";
        }
    }
    ?>
</body>
</html>
