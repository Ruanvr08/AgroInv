<?php

class Estoques extends Controller{
    public $estoqueModel;

    public function __construct(){
        $this->estoqueModel =$this->model('Estoque');
    }
    public function index() {
        $dados = [];
        $formulario = filter_input_array(INPUT_POST);
        $categoria = isset($formulario['categoria']) ? $formulario['categoria'] : null;

        if(isset($categoria) && ($categoria != "")){
            $dados = [
                'form' => $formulario,
                'produtos' => $this->estoqueModel->pesquisar($categoria)
            ];
        } elseif($categoria = null) {
            $dados = [
                'form' => $formulario,
                'produtos' => $this->estoqueModel->trazerProdutos()
            ];
        }elseif($categoria = ""){
            $dados = [
                'form' => $formulario,
                'produtos' => $this->estoqueModel->trazerProdutos()
            ]; 
        }else{
            $dados = [
                'form' => $formulario,
                'produtos' => $this->estoqueModel->trazerProdutos()
            ]; 
        }
        
        
        $this->view('estoques/index', $dados);
    }
    
    
    
    public function cadastrar(){
    	if($_SESSION['usuario_tipo'] == 'admin'){
            $formulario = filter_input_array(INPUT_POST);

            if(isset($formulario)){
                
                $nome = $formulario['nome'];
                $unidade = $formulario['unidade'];
                $quantidade = $formulario['quantidade'];
                $validade = $formulario['validade'];
                $tipoProduto = $formulario['validade'];
                $categoria = $formulario['categoria'];
                
                $this->estoqueModel->cadastrar( $quantidade, $validade, $nome, $unidade, $categoria);
            }
        }
        Url::redirecionar('estoques/index');
        $this->view('estoques/cadastrar', $dados);
    }
    public function editar(){
        if($_SESSION['usuario_tipo'] == 'admin'){
            $formulario = filter_input_array(INPUT_POST);

            if(isset($formulario)){
                
            $url = $_SERVER['REQUEST_URI'];
            $id = null;

            if (preg_match('/\/editar\/(\d+)/', $url, $matches)) {
                $id = $matches[1]; 
            }
                $nome = $formulario['nome'];
                $unidade = $formulario['unidade'];
                $quantidade = $formulario['quantidade'];
                $validade = $formulario['validade'];
                $categoria = $formulario['categoria'];
                
                $this->estoqueModel->editar($id, $quantidade, $validade,$nome, $unidade, $categoria);
            }
            $dados = [
                'form' => $formulario,
    
            ];
        }
        Url::redirecionar('estoques/index');
        $this->view('estoques/editar', $dados);
    }
    public function deletar(){
        if($_SESSION['usuario_tipo'] == 'admin'){

            $url = $_SERVER['REQUEST_URI'];
            $id = null;

            if (preg_match('/\/deletar\/(\d+)/', $url, $matches)) {
                $id = $matches[1]; 
            }
                
            $this->estoqueModel->deletar($id);
        }
        Url::redirecionar('estoques/index');
        $this->view('estoques/deletar');
    }
    
}
