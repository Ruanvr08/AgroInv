<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senhor do Tempo</title>
</head>
<body>
    <h1>Receba Bill</h1>


    <?php
    date_default_timezone_set("America/Sao_Paulo");
    $data = date("d/m/Y");
    $hora = date("G:i:s");
    echo "Hoje é dia $data";
    echo "e agora são $hora";
    ?>


</body>
</html>