<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Dados: </h1>
    </header>
    <main>
        <?php 
        $nome = trim($_GET["Nome"]);
        $gmail = trim($_GET["email"]);
        $senha = $_GET["senha"];
        
        if (empty($nome)) {
            echo "Preencha todos os campos obrigatórios";
            echo '<p><a href="javascript:history.back()">Voltar</a></p>';
        }
        else {
            echo "Prazer te conhecer $nome";
            echo "<br>";
            echo "<br>";
            echo "Email:" . $gmail;  
            echo '<p><a href="javascript:history.back()">Voltar</a></p>';
        }

        ?>
        
    </main>
    
</body>
</html>
