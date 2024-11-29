<html>

<head>
    <link rel="stylesheet" href="/AgroInv/public/css/cadastrarturma.css" type="text/css">
</head>

<body>
    <section class="box-container">
        <div class="col-xl-4 col-md-6 mx-auto p-5">
            <div class="card">
                <div class="card-body">
                    <h1>Cadastrar Turma</h1>
                    <form name="cadastrar" method="POST" action="<?php echo URL ?>/turmas/cadastrarturma">

                        <div class="form-group">
                            <label for="nome_turma">Turma: <sup class="text-danger">*</sup></label>
                            <select name="nome_turma" id="nome_turma" class="form-control <?php if (isset($dados['nome_turma'])) { echo $dados['nome_turma_erro'] ? 'is-invalid' : ''; }; ?>">
                                <option value="">Selecione uma turma</option>
                                <option value="TA 302" <?php if (isset($dados['nome_turma']) && $dados['nome_turma'] === 'TA 302') echo 'selected'; ?>>TA 302</option>
                                <option value="TA 301" <?php if (isset($dados['nome_turma']) && $dados['nome_turma'] === 'TA 301') echo 'selected'; ?>>TA 301</option>
                                <option value="AI 107" <?php if (isset($dados['nome_turma']) && $dados['nome_turma'] === 'AI 107') echo 'selected'; ?>>AI 107</option>
                                <option value="AI 207" <?php if (isset($dados['nome_turma']) && $dados['nome_turma'] === 'AI 207') echo 'selected'; ?>>AI 207</option>
                                <option value="AI 307" <?php if (isset($dados['nome_turma']) && $dados['nome_turma'] === 'AI 307') echo 'selected'; ?>>AI 307</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $dados['nome_turma_erro'] ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ano_ingresso">Ano de Ingresso: <sup class="text-danger">*</sup></label>
                            <input type="text" name="ano_ingresso" id="ano_ingresso" maxlength="4" class="form-control <?php if (isset($dados['ano_ingresso_erro'])) { echo $dados['ano_ingresso_erro'] ? 'is-invalid' : ''; }; ?>"> 

                            <div class="invalid-feedback">
                                <?= $dados['ano_ingresso_erro'] ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="quantidade_alunos">Quantidade de Alunos: <sup class="text-danger">*</sup></label>
                            <input type="number" name="quantidade_alunos" id="quantidade_alunos" class="form-control <?php if (isset($dados['quantidade_alunos']) && !empty($dados['quantidade_alunos_erro'])) {
                                echo 'is-invalid';} ?>">
                            <div class="invalid-feedback">
                                <?= $dados['quantidade_alunos_erro'] ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="submit" value="Cadastrar" class="btn btn-info btn-block">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>