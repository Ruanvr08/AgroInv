<?php

class Turmas extends Controller{

    public $turmasModel; 
    public $usuarioModel;
    


    public function __construct(){
        $this->turmasModel =$this->model('Turma');
        $this->usuarioModel = $this->model('Usuario');
    }

    public function cadastrarturma(){
            $formulario = filter_input_array(INPUT_POST);
        if (isset($formulario)) {
            $dados = [
                'nome_turma' => trim($formulario['nome_turma']),
                'quantidade_alunos' => trim($formulario['quantidade_alunos']),
                'ano_ingresso' => trim($formulario['ano_ingresso']),
                'turmas' => $this->turmasModel->lerTurmas()
            ];
            if (in_array("", $formulario)) {
                if (empty($formulario['nome_turma'])) {
                    $dados['nome_turma_erro'] = "Preencha o campo nome";
                }
                if (empty($formulario['quantidade_alunos'])) {
                    $dados['quantidade_alunos_erro'] = "Preencha o campo quantidade de alunos";
                }
                if (empty($formulario['ano_ingresso'])) {
                    $dados['ano_ingresso_erro'] = "Preencha o campo ano de ingresso";
                }
                
            } else {
               if($this->turmasModel->checarNomeTurma($formulario['nome_turma'])){
                    $dados['nome_turma_erro'] = "Turma ja cadastrada";
                }else{
                    if(preg_match("/^\d{4}$/",$formulario['ano_ingresso'])){
                        if($this->turmasModel->armazenar($dados)){
                            Sessao::mensagem('turma', " Turma cadastrada com sucesso");  
                            Url::redirecionar('usuarios/gerenciarturmas');
                                                    
                        }else{
                            die("Erro ao armazenar turma no banco de dados");
                        }
                    }else{
                        $dados['ano_ingresso_erro'] = "Ano de ingresso deve conter exatamente 4 dígitos numéricos.";
                    }   
                }
            }
            
        } else {
            $dados = [
                'nome_turma' => '',
                'quantidade_alunos' => '',
                'ano_ingresso' => '',
                'nome_turma_erro' => '',
                'quantidade_alunos_erro' => '',
                'ano_ingresso_erro' => '',
                'turmas'=>$this->turmasModel->lerTurmas()
                
            ];
        }

        $this->view('turmas/cadastrarturma', $dados);
    }
    public function verturmas($id){
        
        $dados = [
            'turmas'=>$this->turmasModel->lerTurmaPorId($id)
        ];
        
        $this->view('turmas/verturmas', $dados);

    }
    public function editar($id){
        
        $formulario = filter_input_array(INPUT_POST);
        if (isset($formulario)) {
            $dados = [
                'id' => $id,
                'nome_turma' => trim($formulario['nome_turma']),
                'quantidade_alunos' => trim($formulario['quantidade_alunos']),
                'ano_ingresso' => trim($formulario['ano_ingresso']),
                
            ];
            if(in_array("", $formulario)){
                if(empty($dados['nome_turma'])) {
                    $dados['nome_turma'] = "Preencha o campo nome";
                }
                if (empty($dados['quantidade_alunos'])) {
                    $dados['quantidade_alunos_erro'] = "Preencha o campo quantidade de alunos";
                }
                if (empty($dados['ano_ingresso'])) {
                    $dados['ano_ingresso_erro'] = "Preencha o campo ano de ingresso";
                }
            }else{
                if($this->turmasModel->editar($dados)){
                    Sessao::mensagem('turma', 'Turma editada com sucesso!');
                    Url::redirecionar('usuarios/gerenciarturmas');
                }else{
                    echo ("Erro ao editar turma!");
                }
            }    
        }else {

            $turma = $this->turmasModel->lerTurmaPorId($id);

            if('admin' != $_SESSION['usuario_tipo']){
                Sessao::mensagem('turma', 'Voce nao tem permissao para editar essa turma', 'alert alert-danger');
                Url::redirecionar('home');
            }
            $dados = [
                'id' => $turma->id,
                'nome_turma' => $turma->nome_turma,
                'quantidade_alunos' => $turma->quantidade_alunos,
                'ano_ingresso' => $turma->ano_ingresso,
                'nome_turma_erro' => '',
                'quantidade_alunos_erro' => '',
                'ano_ingresso_erro' => '',
            ];
        }
        
        $this->view('turmas/editar', $dados);
    } 
    public function deletar($id){
        if($this->checarAutorizacao($id)){
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

            if( $metodo == 'POST'){
                if($this->turmasModel->deletar($id)){
                    Sessao::mensagem('turma', 'Turma deletada com sucesso!' );
                    Url::redirecionar('usuarios/gerenciarturmas');
                }
            }else{
                Sessao::mensagem('turma', 'Voce nao tem permissao para deletar essa turma!', 'alert alert-danger');
                Url::redirecionar('usuarios/gerenciarturmas');
            } 
        }else{
            Sessao::mensagem('turma', 'Voce nao tem permissao para deletar essa turma!', 'alert alert-danger');
            Url::redirecionar('usuarios/gerenciarturmas');
        }

        $dados = [
            'professores'=>$this->usuarioModel->lerProfessores(),
            'turmas'=>$this->turmasModel->lerTurmas()
        ];
        
        $this->view('turmas/deletar', $dados);

         
    }
    private function checarAutorizacao($id){
        $usuario = $this->usuarioModel->lerUsuarioPorId($id);

        if($usuario->id_usuario != $_SESSION['usuario_id'] || $_SESSION['usuario_tipo'] == "admin"){
            return true;
        }else{
            return false;
        }
    }
}