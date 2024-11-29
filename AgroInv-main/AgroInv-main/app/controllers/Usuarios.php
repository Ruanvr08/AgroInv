<?php 

class Usuarios extends Controller{

    public $usuarioModel; 
    public $turmaModel;

    public function __construct(){
        $this->usuarioModel =$this->model('Usuario');
        $this->turmaModel = $this->model('Turma');
    }
    public function cadastrar(){ 
        //para cadastrar alguem voce tem que ser admin, porem vou deixar para nao logado poder fazer tb por enquanto
        if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin' || empty($_SESSION['usuario_id'])){
            $formulario = filter_input_array(INPUT_POST);
            if (isset($formulario)) {
                $dados = [
                    'nome' => trim($formulario['nome']),
                    'tipo_usuario' => trim($formulario['tipo_usuario']),
                    'email' => trim($formulario['email']),
                    'senha' => trim($formulario['senha']),
                    'confirmar_senha' => trim($formulario['confirmar_senha']),
                ];
                if (in_array("", $formulario)) {
                    if (empty($formulario['tipo_usuario'])) {
                        $dados['tipo_usuario_erro'] = "Preencha o campo tipo_usuario";
                    }
                    if (empty($formulario['nome'])) {
                        $dados['nome_erro'] = "Preencha o campo nome";
                    }
                    if (empty($formulario['email'])) {
                        $dados['email_erro'] = "Preencha o campo email";
                    }
                    if (empty($formulario['senha'])) {
                        $dados['senha_erro'] = "Preencha o campo senha";
                    }
                    if (empty($formulario['confirmar_senha'])) {
                        $dados['confirmar_senha_erro'] = "Preencha o campo confirmar senha";
                    }
                } else {
                    if (Valida::validarNome($formulario['nome'])) {
                        $dados['nome_erro'] = 'O nome digitado é inválido';
                    } elseif (Valida::validarEmail($formulario['email'])) {
                        $dados['email_erro'] = 'O email digitado é inválido';
                    
                    } elseif($this->usuarioModel->checarEmail($formulario['email'])){
                        $dados['email_erro'] = "Email ja cadastrado";
                    } elseif (strlen($formulario['senha']) < 6) {
                        $dados['senha_erro'] = "Sua senha precisa ter mais de 6 caracteres";
                    } elseif ($formulario['senha'] != $formulario['confirmar_senha']) {
                        $dados['confirmar_senha_erro'] = "As senhas nao coincidem";
                    } else {
                        $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);

                        if($this->usuarioModel->armazenar($dados)){
                            echo Sessao::mensagem('usuario', 'Cadrasto realizado com sucesso!');
                            Url::redirecionar('usuarios/login');
                        }else{
                            die("Erro ao armazenar usuario no banco de dados");
                        }  
                    }
                }
            } else {
                $dados = [
                    'nome' => '',
                    'tipo_usuario' =>'',
                    'email' => '',
                    'senha' => '',
                    'confirmar_senha' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                    'confirmar_senha_erro' => '',
                ];
            }
            
            $this->view('usuarios/cadastrar', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }    
    }
    public function login(){
        
        $formulario = filter_input_array(INPUT_POST);
        if (isset($formulario)) {
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                
            ];
            if (in_array("", $formulario)) {
                if (empty($formulario['email'])) {
                    $dados['email_erro'] = "Preencha o campo email";
                }
                if (empty($formulario['senha'])) {
                    $dados['senha_erro'] = "Preencha o campo senha";
                } 
            } else {
                if (Valida::validarEmail($formulario['email'])) {
                    $dados['email_erro'] = 'O email digitado é inválido';
                   
                }else {
                    $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);
                    if($usuario){
                        $this->criarSessaoUsuario($usuario);
                    }else{
                        Sessao::mensagem('usuario', 'Usuario ou senha Invalidos','alert alert-danger');
                    }
                }
            }
            
        } else {
            $dados = [  
                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => '', 
            ];
        }
        
        $this->view('usuarios/login', $dados);
    }
    private function criarSessaoUsuario($usuario){
        $_SESSION['usuario_id']= $usuario->id_usuario;
        $_SESSION['usuario_nome'] = $usuario->nome_usuario;
        $_SESSION['usuario_email']= $usuario->email_usuario;
        $_SESSION['usuario_tipo']= $usuario->tipo_usuario;

        //adm é redirecionado para a home adm
        if($_SESSION['usuario_tipo'] == "admin"){
            Url::redirecionar('usuarios/homeadm');
        }else{
            //o resto para a home
            Url::redirecionar('home');
        }
        
    }
    public function sair(){
        unset( $_SESSION['usuario_id']);
        unset( $_SESSION['usuario_nome']);
        unset( $_SESSION['usuario_email']);
        unset($_SESSION['usuario_tipo']);

        session_destroy();

        Url::redirecionar('usuarios/login');
    }
    //apenas adms podem acessar a home adm
    public function homeadm(){
        
        if($_SESSION['usuario_tipo']=='admin'){

            $this->view('usuarios/homeadm');
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }  
    }
    //apenas adms podem acessar o gerenciar professores e turmas
    public function gerenciarprofs_turmas(){
        if($_SESSION['usuario_tipo'] == 'admin'){
            $formulario = filter_input_array(INPUT_POST);
                if (isset($formulario)) {
                    $dados = [
                        'nome' => trim($formulario['nome']),
                        'tipo_usuario' => trim($formulario
                        ['tipo_usuario']),
                        'email' => trim($formulario['email']),
                        'senha' => trim($formulario['senha']),
                        'confirmar_senha' => trim($formulario['confirmar_senha']),
                        'professores' => $this->usuarioModel->lerProfessores(),
                        'turmas'=>$this->turmaModel->lerTurmas()
                    ];
                    if (in_array("", $formulario)) {
                        if (empty($formulario['tipo_usuario'])) {
                            $dados['tipo_usuario_erro'] = "Preencha o campo tipo_usuario";
                        }
                        if (empty($formulario['nome'])) {
                            $dados['nome_erro'] = "Preencha o campo nome";
                        }
                        if (empty($formulario['email'])) {
                            $dados['email_erro'] = "Preencha o campo email";
                        }
                        if (empty($formulario['senha'])) {
                            $dados['senha_erro'] = "Preencha o campo senha";
                        }
                        if (empty($formulario['confirmar_senha'])) {
                            $dados['confirmar_senha_erro'] = "Preencha o campo confirmar senha";
                        }
                    } else {
                        if (Valida::validarNome($formulario['nome'])) {
                            $dados['nome_erro'] = 'O nome digitado é inválido';
                        } elseif (Valida::validarEmail($formulario['email'])) {
                            $dados['email_erro'] = 'O email digitado é inválido';
                        
                        } elseif($this->usuarioModel->checarEmail($formulario['email'])){
                            $dados['email_erro'] = "Email ja cadastrado";
                        } elseif (strlen($formulario['senha']) < 6) {
                            $dados['senha_erro'] = "Sua senha precisa ter mais de 6 caracteres";
                        } elseif ($formulario['senha'] != $formulario['confirmar_senha']) {
                            $dados['confirmar_senha_erro'] = "As senhas nao coincidem";
                        } else {
                            $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
                        
                            if($this->usuarioModel->armazenar($dados)){
                                Sessao::mensagem('professor', "Cadastrado com sucesso");  
                                Url::redirecionar('usuarios/gerenciarprofs_turmas');
                                                    
                            }else{
                                die("Erro ao armazenar usuario no banco de dados");
                            } 
                        }
                }
                
            } else {
                $dados = [
                    'nome' => '',
                    'tipo_usuario' =>'',
                    'email' => '',
                    'senha' => '',
                    'confirmar_senha' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                    'confirmar_senha_erro' => '',
                    'professores'=>$this->usuarioModel->lerProfessores(),
                    'turmas'=>$this->turmaModel->lerTurmas()
                
                ];
            }
        
            $this->view('usuarios/gerenciarprofs_turmas', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }
    }

    //apenas adms podem "ver os professores"
    public function verprofs($id){
        
        
        if($_SESSION['usuario_tipo']=='admin'){
            $dados = [
                'professores'=>$this->usuarioModel->lerUsuarioPorId($id)
            ];
            
            $this->view('usuarios/verprofs', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }    

    }

    //rotas prof e turma, acho que fiz cagada, desculpaaa

    public function gerenciarprofs(){
                $dados = [
                
                    'professores'=>$this->usuarioModel->lerProfessores(),
                ];
            
        $this->view('usuarios/gerenciarprofs', $dados);

    }

    public function gerenciarturmas(){     
            $dados=[
                'turmas'=>$this->turmaModel->lerTurmas()
            ];
        
        $this->view('usuarios/gerenciarturmas', $dados);
    }

    //apenas adms podem deletar alguem
    public function deletar($id){
        if($_SESSION['usuario_tipo'] == 'admin'){
            if($this->checarAutorizacao($id)){
                $id = filter_var($id, FILTER_VALIDATE_INT);
                $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    
                if( $metodo == 'POST'){
                    if($this->usuarioModel->deletar($id)){
                        Sessao::mensagem('professor', 'Professor deletado com sucesso!' );
                        Url::redirecionar('usuarios/gerenciarprofs');
                    }
                }else{
                    Sessao::mensagem('professor', 'Voce nao tem permissao para deletar esse professor!', 'alert alert-danger');
                    Url::redirecionar('usuarios/gerenciarprofs');
                } 
            }else{
                Sessao::mensagem('professor', 'Voce nao tem permissao para deletar esse professor!', 'alert alert-danger');
                Url::redirecionar('usuarios/gerenciarprofs');
            }
    
            $dados = [
                'professores'=>$this->usuarioModel->lerProfessores(),
                'turmas'=>$this->turmaModel->lerTurmas()
            ];
            
            $this->view('usuarios/deletar', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }
    }
    private function checarAutorizacao($id){
        $usuario = $this->usuarioModel->lerUsuarioPorId($id);

        if($usuario->id_usuario != $_SESSION['usuario_id'] || $_SESSION['usuario_tipo'] == "admin"){
            return true;
        }else{
            return false;
        }
    } 

    //apenas adms podem editar outros usuarios
    public function editar($id){

        if($_SESSION['usuario_tipo']=='admin') {
            $formulario = filter_input_array(INPUT_POST);
        if (isset($formulario)) {
            $dados = [
                'id_usuario' => $id,
                'nome_usuario' => trim($formulario['nome_usuario']),
                'email_usuario' => trim($formulario['email_usuario']),
                
            ];
            if(in_array("", $formulario)){
                if(empty($dados['nome_usuario'])) {
                    $dados['nome_usuario'] = "Preencha o campo nome";
                }
                if (empty($dados['email_usuario'])) {
                    $dados['email_usuario_erro'] = "Preencha o campo email";
                }
            }else{
                if($this->usuarioModel->editar($dados)){
                    Sessao::mensagem('professor', 'Professor editado com sucesso!');
                    Url::redirecionar('usuarios/gerenciarprofs');
                }else{
                    echo ("Erro ao editar professor!");
                }
            }    
        }else {

            $usuario = $this->usuarioModel->lerUsuarioPorId($id);

            if('admin' != $_SESSION['usuario_tipo']){
                Sessao::mensagem('professor', 'Voce nao tem permissao para editar esse professor', 'alert alert-danger');
                Url::redirecionar('usuarios/gerenciarprofs');
            }
            $dados = [
                'id_usuario' => $usuario->id_usuario,
                'nome_usuario' => $usuario->nome_usuario,
                'email_usuario' => $usuario->email_usuario,
                'nome_usuario_erro' => '',
                'email_usuario_erro' => '',
            ];
        }
        
            $this->view('usuarios/editar', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }
        
        
    }  
    public function cadastrarprof(){
        if($_SESSION['usuario_tipo']=='admin'){
            $formulario = filter_input_array(INPUT_POST);
            if (isset($formulario)) {
                $dados = [
                    'nome' => trim($formulario['nome']),
                    'tipo_usuario' => trim($formulario
                    ['tipo_usuario']),
                    'email' => trim($formulario['email']),
                    'senha' => trim($formulario['senha']),
                    'confirmar_senha' => trim($formulario['confirmar_senha']),
                    'professores' => $this->usuarioModel->lerProfessores()
                ];
                if (in_array("", $formulario)) {
                    if (empty($formulario['tipo_usuario'])) {
                        $dados['tipo_usuario_erro'] = "Preencha o campo tipo_usuario";
                    }
                    if (empty($formulario['nome'])) {
                        $dados['nome_erro'] = "Preencha o campo nome";
                    }
                    if (empty($formulario['email'])) {
                        $dados['email_erro'] = "Preencha o campo email";
                    }
                    if (empty($formulario['senha'])) {
                        $dados['senha_erro'] = "Preencha o campo senha";
                    }
                    if (empty($formulario['confirmar_senha'])) {
                        $dados['confirmar_senha_erro'] = "Preencha o campo confirmar senha";
                    }
                } else {
                    if (Valida::validarNome($formulario['nome'])) {
                        $dados['nome_erro'] = 'O nome digitado é inválido';
                    } elseif (Valida::validarEmail($formulario['email'])) {
                        $dados['email_erro'] = 'O email digitado é inválido';
                       
                    } elseif($this->usuarioModel->checarEmail($formulario['email'])){
                        $dados['email_erro'] = "Email ja cadastrado";
                    } elseif (strlen($formulario['senha']) < 6) {
                        $dados['senha_erro'] = "Sua senha precisa ter mais de 6 caracteres";
                    } elseif ($formulario['senha'] != $formulario['confirmar_senha']) {
                        $dados['confirmar_senha_erro'] = "As senhas nao coincidem";
                    } else {
                        $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
                        echo "oie";
                       
                        if($this->usuarioModel->armazenar($dados)){
                            Sessao::mensagem('usuario', "Professor cadastrado com sucesso");  
                            Url::redirecionar('usuarios/gerenciarprofs');
                                                  
                        }else{
                            die("Erro ao armazenar usuario no banco de dados");
                        }   
                    }
                }
                
            } else {
                $dados = [
                    'nome' => '',
                    'tipo_usuario' =>'',
                    'email' => '',
                    'senha' => '',
                    'confirmar_senha' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                    'confirmar_senha_erro' => '',
                    'professores'=>$this->usuarioModel->lerProfessores()
                ];
            }
            $this->view('usuarios/cadastrarprof', $dados);
        }else{
            Url::redirecionar('home');
            Sessao::mensagem('permissao', 'Voce não tem permissao para acessar essa àrea','alert alert-danger');
        }
    }                  
       
}
    