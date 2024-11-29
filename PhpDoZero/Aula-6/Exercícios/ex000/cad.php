<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado: </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Resultado:</h1></header>
<main>

<?php 
    $numero = $_POST["number"];
    $ant = $numero - 1;
    $suc = $numero + 1;

    echo  "Número digitado: $numero ";
    echo '<br>';
    echo "Antecessor: $ant" ;
    echo "<br>";
    echo "Sucessor: $suc";
    ?>

</main>
   



</body>
</html>