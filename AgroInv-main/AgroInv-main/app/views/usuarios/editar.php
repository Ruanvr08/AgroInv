<header>
    <link rel="stylesheet" href="/AgroInv/public/css/editarprof.css" type="text/css">
</header>
<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL?>/usuarios/gerenciarprofs">Professores</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Editar</a></li>
        </ol>
    </div>
    <div class="card">
        <card class="card-header bg-secondary text-white">
            Editar Professores
        </card>
        <div class="card-body">
            <form name="login" method="POST" class="mt-4" action="<?= URL?>/usuarios/editar/<?= $dados['id_usuario']?>">

                <div class="form-group">
                    <label for="nome_usuario">Nome :<sup class="text-danger">*</sup></label>
                    <input type="text"
                        class="form-control <?php if(isset($dados['nome_usuario'])){echo $dados['nome_usuario_erro'] ? 'is-invalid' : '';}; ?>"
                        name="nome_usuario" id="nome_usuario" value="<?php echo $dados['nome_usuario']?>">
                    <div class="invalid-feedback">
                        <?= $dados['titulo_erro'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email_usuario">Email :<sup class="text-danger">*</sup></label>
                    <input type="email_usuario"
                        class="form-control <?php if(isset($dados['email_usuario_erro'])){echo $dados['email_usuario_erro'] ? 'is-invalid' : '';}; ?>"
                        name="email_usuario" id="email_usuario" value="<?php echo $dados['email_usuario']?>">
                    <div class="invalid-feedback">
                        <?= $dados['email_usuario_erro'] ?>
                    </div>
                </div>

        </div>
        <input type="submit" value="Editar" class="btn btn-info btn-block">
        </form>
    </div>
</div>
</div>