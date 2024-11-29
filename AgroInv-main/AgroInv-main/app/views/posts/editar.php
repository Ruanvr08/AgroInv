<header>
    <link rel="stylesheet" href="/AgroInv/public/css/cadastropost.css" type="text/css">
</header>
<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URL?>/posts">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Editar</a></li>
        </ol>
    </div>
    <div class="card">
        <card class="card-header bg-secondary text-white">
            Editar Posts
        </card>
        <div class="card-body">
            <form name="login" method="POST" class="mt-4" action="<?= URL?>/posts/editar/<?= $dados['id_post']?>">

                <div class="form-group">
                    <label for="titulo">Titulo <sup class="text-danger">*</sup></label>
                    <input type="text"
                        class="form-control <?php if(isset($dados['titulo_erro'])){echo $dados['titulo_erro'] ? 'is-invalid' : '';}; ?>"
                        name="titulo" id="titulo" value="<?php echo $dados['titulo']?>">
                    <div class="invalid-feedback">
                        <?= $dados['titulo_erro'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="texto">Texto: <sup class="text-danger">*</sup></label>
                    <textarea
                        class="form-control <?php if(isset($dados['texto_erro'])) { echo $dados['texto_erro'] ? 'is-invalid' : ''; } ?>"
                        name="texto" id="texto"><?php echo $dados['texto']?>
                    </textarea>
                    <?php if(isset($dados['texto_erro']) && $dados['texto_erro']) { ?>
                    <div class="invalid-feedback">
                        <?= $dados['texto_erro'] ?>
                    </div>
                    <?php } ?>
                </div>
                <input type="submit" value="Editar" class="btn btn-info btn-block">
            </form>
        </div>
    </div>
</div>