<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Professor</title>
    <link rel="stylesheet" href="/AgroInv/public/css/verprofs.css" type="text/css">
</head>
<body>
    <div class="container my-5">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo URL ?>/usuarios/gerenciarprofs">Professores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $dados['professores']->nome_usuario ?></li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                <h3><?= $dados['professores']->nome_usuario ?></h3>
            </div>
            <div class="card-body">
                <p><strong>Nome:</strong> <?= $dados['professores']->nome_usuario ?></p>
                <p><strong>Email: </strong> <?= $dados['professores']->email_usuario ?></p>
            </div>
            <div class="card-footer text-muted">
                <?php if ($_SESSION['usuario_tipo'] === "admin"): ?>
                <div class="text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="<?= URL . '/usuarios/editar/' . $dados['professores']->id_usuario ?>" class="btn btn-sm btn-primary">Editar Professor</a>
                        </li>
                        <li class="list-inline-item">
                            <form action="<?= URL . '/usuarios/deletar/' . $dados['professores']->id_usuario ?>" method="POST">
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
