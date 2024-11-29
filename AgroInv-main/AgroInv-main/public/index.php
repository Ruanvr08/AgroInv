<?php
    session_start();
    include './../app/configuracao.php';
    include './../app/autoload.php';
    
    $db = new Database;

    /**
     * insercao de valores
     * 
     *  $usuarioId = 11;
     *  $titulo = 'Titulo do post';
     *  $texto = 'Texto do post';
     *  $db->query("INSERT INTO posts (id_usuario, titulo, texto) values (:usuario_id ,:titulo,:texto)");
     *  $db->bind(":usuario_id", $usuarioId);
     *  $db->bind(":titulo", $titulo);
     *  $db->bind(":texto", $texto);
     *  $db->executa();
     *  echo "<hr>Total de Resultados ".$db->totalResultados();
     *  echo "<hr>Ultimo id inserido ".$db->ultimoIdInserido();
     * 
     */

    
    /**
     * atualizacao de valores
     * 
     *  $usuarioId = 13;
     *  $titulo = 'Titulo do post';
     *  $texto = 'Texto do post';
     *  $db->query("UPDATE posts SET id_usuario = :usuario_id,  titulo = :titulo, texto = :texto");
     *  $db->bind(":usuario_id", $usuarioId);
     *  $db->bind(":titulo", $titulo);
     *  $db->bind(":texto", $texto);
     *  $db->executa();
     *  echo "<hr>Total de Resultados ".$db->totalResultados();
     * 
     */
    
    
    /** 
     * exclusao de valores
     * 
     *  $id_post = 1;
     *  $db->query("DELETE FROM posts WHERE id_post =:id_post");
     *  $db->bind(":id_post", $id_post);
     *  $db->executa();
     *  echo "<hr>Total de Resultados ".$db->totalResultados();
     * 
     */

    
     /** 
     * selecao de um valor
     * 
     *  $db->query("SELECT * FROM posts ");
     *  $db->resultado();
     *  echo $db->resultado()->titulo;
     * 
     */
    
    /** 
     * selecao de valores
     * 
     *  $db->query("SELECT * FROM posts ORDER BY id_post DESC");
     *  foreach ($db->resultados() as $post){
     *      echo $post->id_post.'-'.$post->titulo.'<br>';
     *  }
     * 
     */
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NOME?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL?>/public/css/estilos.css">
</head>
<body>
    <?php
        
        include '../app/views/topo.php';
        $rotas = new Rota();
        include '../app/views/rodape.php';
        

    ?>
</body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    
</html>