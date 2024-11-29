<html>
<body>
    <header>
        <nav>
            <!-- Para definir as seções de usuário, mudando os itens na barra de acordo com a seção !-->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <!-- Menu hamburguer huuuum!-->
                <div class="mobile-menu">
                    <div class="linha1"></div>
                    <div class="linha2"></div>
                    <div class="linha3"></div>
                </div>

                <!-- Itens da navbar do professor !-->
                <?php if ($_SESSION['usuario_tipo'] == 'professor'): ?>
                    <ul class="navlist">
                        <li><a href="<?php echo URL ?>/calendarios/calendarioAdm" class="Calendario" data-toggle="tooltip"
                                title="Calendario">Calendario</a>
                        </li>

                        <li><a href="<?php echo URL ?>/posts" class="Blog" data-toggle="tooltip" title="Blog">Blog</a>
                        </li>

                    </ul>
                    <a href="<?php echo URL ?>/home">
                        <img src="/AgroInv/public/img/logoAgroInv.png" onmouseover="Tip('Home')" onmouseout="UnTip()" class="logagroinv" alt="logo"
                            style="width:80px; height:60%;">
                    </a>

                    <!-- Itens da navbar do admin, sei que repeti o blog nas duas Navlists e isso não é o mais correto, mas foi uma forma provisória que encontrei para deixar tudo funcionando bonitinho no menu hamburguer !-->

                <?php endif; ?>
                <?php if ($_SESSION['usuario_tipo'] == 'admin'): ?>
                    <ul class="navlist">
                        <li><a href="<?php echo URL ?>/usuarios/homeadm" class="Painel" data-toggle="tooltip"
                                title="PainelControle">Painel de controle</a></li>
                        <li><a href="<?php echo URL ?>/posts" class="Blog" data-toggle="tooltip" title="Blog">Blog</a>
                        </li>
                    </ul>
                    <a href="<?php echo URL ?>/home">
                        <img src="/AgroInv/public/img/logoAgroInv.png" onmouseover="Tip('Home')" onmouseout="UnTip()" class="logoagroinv" alt="logo"
                            style="width:80px; height:60%;">
                    </a>
                <?php endif; ?>

                <!-- onmouseover é uma função para aparecer uma mensagem ao passar o mouse em cima da imagem !-->
                <a class="nav-item active" href="<?php echo URL ?>/usuarios/sair">
                    <img src="/AgroInv/public/img/leave.png" onmouseover="Tip('Sair')" onmouseout="UnTip()" alt="sair"
                        style="width:40px; height:60%;">

                </a>

                <!-- Quando for um usuário comum !-->
            <?php else: ?>
                <a class="logoIF" href="<?php echo URL ?>">
                    <img src="/AgroInv/public/img/if_logo.png" width="130" onmouseover="Tip('Home')" onmouseout="UnTip()" height="50%" style="margin-top:5px;" />
                </a>
                <ul class="navlist">
                    <li><a href="<?php echo URL ?>/posts" class="Blog"> Blog </a></li>
                    <li><a href="<?php echo URL ?>/usuarios/login" class="btn btn-info"> Login </a></li>
                </ul>
                <!-- Menu hamburguer huuuum!-->
                <div class="mobile-menu">
                    <div class="linha1"></div>
                    <div class="linha2"></div>
                    <div class="linha3"></div>
                </div>

            <?php endif; ?>

        </nav>
    </header>
    <!-- chamando o CSS e logo em seguida, o arquivo js para o menu hamburguer funcionar !-->
    <link rel="stylesheet" href="/AgroInv/public/css/topo.css" type="text/css">
    <script src="/AgroInv/public/js/navbar.js"></script>
    <!-- chamando o arquivo js para funcionar as mensagens ao passar o mouse na imagem!-->
    <script type="text/javascript" src="/AgroInv/public/js/wz_tooltip.js"></script>
</body>
</html>