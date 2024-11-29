<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/AgroInv/public/css/gerenciarturmas.css" type="text/css">
</head>
<body>


<?php echo Sessao::mensagem('turma');?>

    <section class="card">

        <h1>Gerenciamento de Turmas</h1>

        <div class="container">
            <?php foreach ($dados['turmas'] as $turma): ?>
                <div class="user">
                    <h2 class="title"><?=$turma->nome_turma?></h2>
                    <div class="infos"> 
                            <p><strong>Ano ingresso</strong> <?= $turma->ano_ingresso ?></p>
                            <p><strong>Quant.Alunos</strong>  <?= $turma->quantidade_alunos ?></p>
                            <a href="<?= URL . '/turmas/verturmas/' . $turma->id ?>" class="btnvermais">Ver Mais</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>