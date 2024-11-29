<?php

$inicio = new \DateTime($dados['eventos'][0]->comeco_evento);
$fim = new \DateTime($dados['eventos'][0]->fim_evento);
?>

<header>
    <link rel="stylesheet" href="/AgroInv/public/css/editaraula.css" type="text/css">
</header>

<body>
<div class="container my-5">

    <div aria-label="breadcrumb">
    <div class="container my-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo URL?>/calendarios/calendarioAdm">Calendario</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Editar</a></li>
            </ol>
        </div>
        </div>
</div>
    <div class="card">
        
        <form name="formEdit" id="formEdit" method="post"
            action="<?= URL ?>/calendarios/atualizar/<?= $dados['eventos'][0]->id_evento ?>" method="post">

            <h2 class="form-title">Formulário de Atualizacao de Aula</h2>

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" name="date" id="date" value="<?= $inicio->format('Y-m-d') ?>">
            </div>

            <div class="form-group">
                <label for="time">Hora Inicio:</label>
                <input type="time" class="form-control" name="start" id="start"
                    value="<?= $inicio->format('H:i:s'); ?>">
            </div>

            <div class="form-group">
                <label for="time">Hora Fim:</label>
                <input type="time" class="form-control" name="end" id="end" value="<?= $fim->format("H:i:s") ?>">
            </div>
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="<?= $dados['eventos'][0]->titulo_evento; ?>">
            </div>
            <input type="hidden" class="form-control" name="id" id="id" value="<?= $dados['eventos'][0]->id_evento ?>">

            <div class="form-group">
                <label for="nome_turma">Turma: <sup class="text-danger">*</sup></label>
                <select name="nome_turma" placeholder="Selecione uma turma" id="nome_turma"
                    class="form-control <?php if (isset($dados['nome_turma'])) { echo $dados['nome_turma_erro'] ? 'is-invalid' : ''; }; ?>">
                    <option value="">Selecione uma turma</option>
                    <?php foreach ($dados["turmas"] as $turma) : ?>
                    <option value="<?php echo $turma->nome_turma ?>"
                        <?php if ($turma->nome_turma === $dados['eventos'][0]->turma_evento) { echo 'selected'; } ?>>
                        <?= $turma->nome_turma ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nome_professor">Professor: <sup class="text-danger">*</sup></label>
                <select name="nome_professor" id="nome_professor" class="form-control <?php if (isset($dados['nome_professor'])) {
        echo $dados['nome_professor_erro'] ? 'is-invalid' : '';
    }; ?>">
                    <option value="">Selecione um professor</option>
                    <?php foreach ($dados["professores"] as $prof) : ?>
                    <option value="<?php echo $prof->nome_usuario ?>"
                        <?php if ($prof->nome_usuario === $dados['eventos'][0]->professor_evento) echo 'selected'; ?>>
                        <?= $prof->nome_usuario ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="laboratorio">Laboratório: <sup class="text-danger">*</sup></label>
                <select name="laboratorio" id="laboratorio" class="form-control <?php if (isset($dados['laboratorio_erro'])) {
        echo $dados['laboratorio_erro'] ? 'is-invalid' : '';
    }; ?>">
                    <option value="">Selecione um laboratório</option>
                    <option value="Laboratorio 1"
                        <?php if ($dados['eventos'][0]->lab_evento === "Laboratorio 1") echo 'selected'; ?>>Laboratório
                        1 - Planificação
                    </option>
                    <option value="Laboratorio 2"
                        <?php if ($dados['eventos'][0]->lab_evento === "Laboratorio 2") echo 'selected'; ?>>Laboratório
                        2 - Vegetais
                    </option>
                    <option value="Laboratorio 3"
                        <?php if ($dados['eventos'][0]->lab_evento === "Laboratorio 3") echo 'selected'; ?>>Laboratório
                        3 - Carnes
                    </option>
                    <option value="Laboratorio 4"
                        <?php if ($dados['eventos'][0]->lab_evento === "Laboratorio 4") echo 'selected'; ?>>Laboratório
                        4 - Leite
                    </option>
                    <option value="Laboratorio 5"
                        <?php if ($dados['eventos'][0]->lab_evento === "Laboratorio 5") echo 'selected'; ?>>Laboratório
                        5 - Sala de aula
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Materiais:</label>
                <input type="text" class="form-control" name="description" id="description"
                    value="<?= $dados['eventos'][0]->descricao_evento; ?>">
            </div>
            
            <div class="form-group">
                <label for="docs">Protocolo da aula:</label>
                <input type="hyperlink" class="form-control" name="docs" id="docs"
                    value="<?= $dados['eventos'][0]->link_aula; ?>">
            </div>
        
            <button type="submit" class="btn btn-primary">Atualizar Aula</button>
            <a href="http://localhost/AgroInv/calendarios/deletar/<?= $dados['eventos'][0]->id_evento ?>">
                <input class="btn btn-primary btn-danger" value="Deletar Aula">
            </a>

        </form>
    </div>
    </div>

</body>