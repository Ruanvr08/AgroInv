<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número Sorteado</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <header><h1>Sorteio</h1></header>
      

    <main> <?php 
    $numeroinicio = $_POST["ninicio"];
    $numerofinal = $_POST["nfinal"];

    $numerosorteado = rand($numeroinicio, $numerofinal);

    echo "O número sorteado foi: $numerosorteado";
    
    
    ?> </main>



    
</body>
</html>