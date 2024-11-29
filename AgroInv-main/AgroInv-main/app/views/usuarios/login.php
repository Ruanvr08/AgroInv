<header>
    <link rel="stylesheet" href="/AgroInv/public/css/login.css" type="text/css">
</header>

<body>
    <?php echo Sessao::mensagem('usuario');?>

    <div class="col-xl-4 col-md-6 mx-auto p-5">
        <div class="card">
           
            <div class="card-body">
            <h1>Login</h1>
                <?php echo Sessao::mensagem('usuario')?>
                <form name="login" method="POST" action="<?php echo URL?>/usuarios/login">

                    <div class="form-group">
                        <label for="email">E-mail: <sup class="text-danger">*</sup></label>
                        <input type="text"
                            class="form-control <?php if(isset($dados['email_erro'])){echo $dados['email_erro'] ? 'is-invalid' : '';}; ?>"
                            name="email" id="email" value="<?php echo $dados['email']?>">
                        <div class="invalid-feedback">
                            <?= $dados['email_erro'] ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha: <sup class="text-danger">*</sup></label>
                        <input type="password"
                            class="form-control <?php if(isset($dados['senha_erro'])){echo $dados['senha_erro'] ? 'is-invalid' : '';}; ?>"
                            name="senha" id="senha">
                        <div class="invalid-feedback">
                            <?= $dados['senha_erro'] ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" value="Entrar" class="btn btn-info btn-block">
                        </div>
                        <div class="col-md-6">
                            <a class="adm" href="<?php echo URL?>/sobre">Nao tem uma conta? Converse com os Administradores</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>