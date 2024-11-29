<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/AgroInv/public/css/gerenciarprofs.css" type="text/css">
</head>
<body>

<?php echo Sessao::mensagem('professor');?>


    <section class="card">

        <h1>Gerenciamento de professores</h1>

        <div class="search-box">
            <input type="text" class="search-txt" placeholder="Buscar professor">
            <a href="#" class="search-btn">
                <i class="fa fa-search"></i>
            </a>
        </div>
        <div class="container">
            <?php foreach ($dados['professores'] as $prof): ?>
                <div class="user">
                    <h2 class="title"><?= $prof->nome_usuario ?></h2>
                    <div class="infos">
                        <p><strong>Nome:</strong> <?= $prof->nome_usuario ?></p>
                        <p><strong>Email:</strong> <?= $prof->email_usuario ?></p>
                        <a href="<?= URL . '/usuarios/verprofs/' . $prof->id_usuario ?>" class="btnvermais">Ver Mais</a>
                    </div>
                </div>
            <?php endforeach ?> 
        </div>
    </section>
</body>

</html>