<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
</head>
<body>
    <h1>Calculadora de Índice de Masa Corporal (IMC)</h1>
    <form action="imc2.php" method="post">
        <h2>Coloca tu peso:</h2>
        <label for="peso">Peso (kg):</label>
        <input type="number" step="0.01" id="peso" name="peso" required><br><br>
        <h2>Coloca tu estatura:</h2>
        <label for="estatura">Estatura (m):</label>
        <input type="number" step="0.01" id="estatura" name="estatura" required><br><br>

        <button type="submit">Calcular IMC</button>
    </form>

</body>
</html>
