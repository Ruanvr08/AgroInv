<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Chamando o css da pagina -->
    <link rel="stylesheet" href="./public/css/index.css" type="text/css">
    <!-- Exportando os arquivos para o carousel-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Página Inicial </title>
</head>

<body>
<?php echo Sessao::mensagem('permissao')?>
    <!-- Para deixar todo conteúdo da pag em um container (ou caixa, para os mais íntimos :p) -->
    <section class="container">
        
        <!-- início do carousel -->
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- indicadores de baixo??? enfim aquele trem que ta brilhando em cima da foto -->

            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                <li data-target="#demo" data-slide-to="3"></li>
            </ul>

            <!-- fotos do carousel -->

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./public/img/entrada.jpg" alt="Bem vindo!">
                </div>
                <div class="carousel-item">
                    <img src="./public/img/lab6.jpg">
                </div>
                <div class="carousel-item">
                    <img src="./public/img/lab7.jpg">
                </div>
                <div class="carousel-item">
                    <img src="./public/img/laboratorio1.jpg">
                </div>
            </div>

            <!-- setas das laterais -->

            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

        <!-- Para dar um espaço entre o carousel e o menu de guias -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
        </div>

        <!-- Fim do carousel -->

        <!-- Início das informações sobre os laboratórios etc etc, botei um espaço em branco pra borda do texto nao ficar minuscula, nao assuta c essa caixa amarela ( é gambiarra) -->

        <article>
            <h1 id='agro'>⠀Agroindústria Campus Pinheiral⠀</h1>
            <br>
            <p>
                ⠀⠀O setor de Agroindústria do IFRJ Campus Pinheiral está localizado próximo à sede administrativa
                e ao posto de vendas e disponibiliza ambientes equipados para o processamento de alimentos aos
                alunos dos cursos técnicos de agroindústria e de agropecuária, contribuindo com a formação de
                profissionais capazes de transformar e agregar valor à matéria-prima.
            </p>
        </article>

        <!-- início descrição dos laboratórios-->
        <article>
            <h1 id='agro'>⠀Laboratório⠀</h1>
            <!-- segunda descrição dos laboratorios -->
            <article>
                <p>
                    ⠀⠀As plantas de produção, além de atender as aulas práticas, têm o objetivo de abastecer o
                    restaurante para a alimentação dos alunos do campus e ao Posto de vendas para a comercialização
                    local dos produtos produzidos no setor. Também são ofertados pela agroindústria estágios
                    supervisionados para os alunos dos cursos técnicos e da graduação, além de disponibilizar os
                    espaços para atividades de Ensino, Pesquisa e Extensão.
                </p>
            </article>
            <!-- fim descrição laboratórios -->
            

            <article id='algum-problema'>
                <br>
                <h2 id='problema'><strong>Se interessou? Venha fazer parte!</strong></p>
                <ul>
                    <h2 id='problema'>Todo ano, o IFRJ abre um edital de provas que lhe permite ingressar em nosso campus, acesse os
                        links
                        abaixo e fique por dentro! Não perca esta oportunidade.</p>
                    <h2 id='problema'><a href="https://portal.ifrj.edu.br/estude-ifrj" target="_blank">Site oficial IFRJ</a></p>
                    <h2 id='problema'><a href="https://www.instagram.com/ifrjpinheiral/" target="_blank">@ifrjpinheiral</a></p>
                </ul>
            </article>



            <article id='contatos'>

                <p>⠀⠀Laboratório de Agroindústria - IFRJ Campus Pinheiral</p>
                <ul>
                    <li><strong>CNPJ:</strong> 10.952.708/0002-87</li>
                    <li><strong>Localização:</strong> Rua José Breves, n°550, Centro, Pinheiral-RJ CEP: 27197-000</li>
                    <li><strong>Telefone:</strong> (24) 33568202 Ramal: 8235</li>
                    <li><strong>E-mail:</strong> datep.cpin@ifrj.edu.br</li>
                    <li><strong>Responsável técnico pela Agroindústria:</strong> Gisele Santos de Meireles (médica
                        veterinária)</li>
                        <li><strong>Ténicos administrativos da agroindústria:</strong> Érika Francisquini Arruda e Patrícia Rodrigues da Silva Cassiano</li>
                    <li><strong>Horário de funcionamento:</strong> 2° a 6° das 07:00 às 17:00 horas</li>  
                </ul>
            </article>
    </section>
</body>

</html>