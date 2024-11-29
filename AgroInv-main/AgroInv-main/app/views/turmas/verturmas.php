<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Turma</title>
    <link rel="stylesheet" href="/AgroInv/public/css/visualizarturma.css" type="text/css">
</head>
<body>
    <div class="container my-5">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo URL ?>/usuarios/gerenciarturmas">Turmas</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $dados['turmas']->nome_turma ?></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <h3><?= $dados['turmas']->nome_turma ?></h3>
            </div>
            <div class="card-body">
                <p><strong>Nome:</strong> <?= $dados['turmas']->nome_turma ?></p>
                <p><strong>Quantidade de alunos: </strong> <?= $dados['turmas']->quantidade_alunos ?></p>
                <p><strong>Ano de Ingresso: </strong> <?= $dados['turmas']->ano_ingresso ?></p>
            </div>
            <div class="card-footer text-muted">
                <?php if ($_SESSION['usuario_tipo'] === "admin"): ?>
                <div class="text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="<?= URL . '/turmas/editar/' . $dados['turmas']->id?>" class="btn btn-sm btn-primary">Editar Turma</a>
                        </li>
                        <li class="list-inline-item">
                            <form action="<?= URL . '/turmas/deletar/' . $dados['turmas']->id ?>" method="POST">
                                <input type="submit" class="btn btn-sm btn-danger" value="Deletar">
                            </form>
                        </li>
                    </ul>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>
