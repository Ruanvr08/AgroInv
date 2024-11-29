<?php 

    $data = new \DateTime($dados['data'], new \DateTimeZone('America/Sao_Paulo')); 

?>
<header>
    <link rel="stylesheet" href="/AgroInv/public/css/cadastroaula.css" type="text/css">
</header>

<body>
    
<div class="container my-5">
    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL?>/calendarios/calendarioAdm">Calendario</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Cadastrar</a></li>
        </ol>
    </div>
</div>
    <section class="card">
    
        <form name="formAdd" id="formAdd" method="post" action="<?= URL ?>/calendarios/cadastrar/<?=$data->format('Y-m-d\TH:i:sP')?>" method="post">

            <h2 class="form-title">Formulário de Cadastro de Aula</h2>

            <div class="form-group <?php if (isset($dados['data_erro'])) {
                echo 'is-invalid';
            } ?>">
                <label for="date">Data:<sup class="text-danger">*</sup></label>
                <input type="date" name="date" id="date" value="<?=$data->format('Y-m-d');?>" class="form-control" required>
                <div class="invalid-feedback">
                        <?= $dados['data_erro'] ?>
                </div>
            </div>

            <div class="form-group <?php if (isset($dados['start_erro'])) {
                    echo 'is-invalid';
                } ?>">
                <label for="start">Hora Início:<sup class="text-danger">*</sup></label>
                <input type="time" class="form-control " name="start" id="start" value="<?= $data->format('H:i'); ?>" required>
            </div>

            <div class="form-group <?php if (isset($dados['end_erro'])) {
                echo 'id-invalid';
            } ?>">
                <label for="end">Hora Fim:<sup class="text-danger">*</sup></label>
                <input type="time" class="form-control <?php if (isset($dados['end_erro'])) {
                    echo 'is-invalid';
                } ?>" name="end" id="end" value=" " >
            </div>

            <div class="form-group <?php if (isset($dados['title_erro'])) {
                echo 'is-invalid';
            } ?>">
                <label for="title">Título Aula:<sup class="text-danger">*</sup></label>
                <input type="text" name="title" id="title" value="" class="form-control " required>
            </div>


            <div class="form-group">
                <label for="nome_turma">Turma: <sup class="text-danger">*</sup></label>
                <select name="nome_turma" placeholder="Selecione uma turma" id="nome_turma" class="form-control <?php if (isset($dados['nome_turma'])) {
                    echo $dados['nome_turma_erro'] ? 'is-invalid' : '';
                }
                ; ?>" required>
                    <option value="">Selecione uma turma<sup class="text-danger">*</sup></option>
                    <?php foreach ($dados["turmas"] as $turma): ?>
                        <option value="<?php echo $turma->nome_turma ?>">
                            <?= $turma->nome_turma ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nome_professor">Professor: <sup class="text-danger">*</sup></label>
                <select name="nome_professor" id="nome_professor" class="form-control <?php if (isset($dados['nome_professor'])) {
                    echo $dados['nome_professor_erro'] ? 'is-invalid' : '';
                }
                ; ?>" required>
                    <option value="">Selecione um professor <sup class="text-danger">*</sup></option>
                    <?php foreach ($dados["professores"] as $prof): ?>
                        <option value="<?php echo $prof->nome_usuario ?>">
                            <?= $prof->nome_usuario ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="laboratorio">Laboratorio: <sup class="text-danger">*</sup></label>
                <select name="laboratorio" id="laboratorio" class="form-control <?php if (isset($dados['nome_professor'])) {
                    echo $dados['laboratorio_erro'] ? 'is-invalid' : '';
                }
                ; ?>" required>
                    <option value="">Selecione um laboratorio</option>
                    <option value="Laboratorio 1">Laboratorio 1 - Planificação</option>
                    <option value="Laboratorio 2">Laboratorio 2 - Vegetais</option>
                    <option value="Laboratorio 3">Laboratorio 3 - Carnes</option>
                    <option value="Laboratorio 4">Laboratorio 4 - Leite</option>
                    <option value="Laboratorio 5">Laboratorio 5 - Sala de Aula</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Materiais:<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="description" id="description"
                    placeholder="Ex : 10L de leite, 10Kg de Milho..." required>
            </div>
            <div class="form-group">
                <label for="docs">Protocolo da aula:<sup class="text-danger">*</sup></label>
                <input type="hyperlink" class="form-control" name="docs" id="docs"
                    placeholder="Insira aqui o link de seu protocolo de aula" required>
            </div>
            <button type="submit" class="btn btn-primary">Marcar Aula</button>
        </form>
    </section>

    
</body>