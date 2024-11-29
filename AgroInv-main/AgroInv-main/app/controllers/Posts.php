<?php

class Posts extends Controller{
    public $postModel;
    public $usuarioModel;

    public function __construct(){
     
        $this->postModel = $this->model('Post');
        $this->usuarioModel = $this->model('Usuario');
    }
    public function index(){
        $dados =[
            'posts' => $this->postModel->lerPosts()
        ];
        $this->view('posts/index', $dados);

    }  
    
    public function cadastrar(){
        if(!Sessao::estaLogado()){
            Url::redirecionar('usuarios/login'); 
         } 
         else{
        $formulario = filter_input_array(INPUT_POST);
        if (isset($formulario)) {
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'id_usuario'=> $_SESSION['usuario_id'],
            ];
            if(in_array("", $formulario)){
                if(empty($dados['titulo'])) {
                    $dados['titulo_erro'] = "Preencha o campo título";
                }
                if (empty($dados['texto'])) {
                    $dados['texto_erro'] = "Preencha o campo texto";
                }
            }else{
                echo "cheguei ate aqui";
                if($this->postModel->armazenar($dados)){
                    Sessao::mensagem('post', 'Post cadastrado com sucesso!');
                    Url::redirecionar('posts');
                    }else{
                        echo ("Erro ao armazenar post no banco de dados");
                    }
            }    
        }else {
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'texto_erro' => '',
            ];
        }
    }
        $this->view('posts/cadastrar', $dados);
    }
    public function editar($id){
        
        $formulario = filter_input_array(INPUT_POST );
        if (isset($formulario)) {
            $dados = [
                'id_post' => $id,
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                
            ];
            if(in_array("", $formulario)){
                if(empty($dados['titulo'])) {
                    $dados['titulo_erro'] = "Preencha o campo título";
                }
                if (empty($dados['texto'])) {
                    $dados['texto_erro'] = "Preencha o campo texto";
                }
            }else{
                if($this->postModel->editar($dados)){
                    Sessao::mensagem('post', 'Post editado com sucesso!');
                    Url::redirecionar('posts');
                    }else{
                        echo ("Erro ao editar post!");
                    }
            }    
        }else {

            $post = $this->postModel->lerPostPorId($id);

            if($post->id_usuario != $_SESSION['usuario_id'] && $_SESSION['usuario_tipo']!='admin'){
                Sessao::mensagem('post', 'Voce nao tem permissao para editar esse post!', 'alert alert-danger');
                Url::redirecionar('posts');
            }
            $dados = [
                'id_post' => $post->id_post,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'titulo_erro' => '',
                'texto_erro' => '',
            ];
        }
        
        $this->view('posts/editar', $dados);
    }
    public function ver($id){
        $post = $this->postModel->lerPostPorId($id);
        $usuario = $this->usuarioModel->lerUsuarioPorId($post->id_usuario);

        $dados = [
            'post' => $post,
            'usuario' =>$usuario
        ];
        
        $this->view('posts/ver', $dados);

    }
    public function deletar($id){
        if(!$this->checarAutorizacao($id) || $_SESSION['usuario_tipo']=='admin'){
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

            if( $metodo == 'POST'){
                if($this->postModel->deletar($id)){
                    Sessao::mensagem('post', 'Post deletado com sucesso!' );
                    Url::redirecionar('posts');
                }
            }else{
                Sessao::mensagem('post', 'Voce nao tem permissao para deletar esse post!', 'alert alert-danger');
                Url::redirecionar('posts');
            } 
        }else{
            Sessao::mensagem('post', 'Voce nao tem permissao para deletar esse post!', 'alert alert-danger');
            Url::redirecionar('posts');
        }
                            
       
    }
    private function checarAutorizacao($id){
        $post = $this->postModel->lerPostPorId($id);

        if($post->id_usuario != $_SESSION['usuario_id'] || $_SESSION['usuario_tipo'] == "admin"){
            return true;
        }else{
            return false;
        }
    }
}