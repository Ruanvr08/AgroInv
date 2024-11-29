<?php

class Paginas extends Controller{
    public function index(){
        $dados = [
            'titulo' => 'Pagina Inicial'
        ];
        $this->view('paginas/home', $dados);
    }
    public function sobre(){
        $dados = [
            'titulo' => 'Sobre Nós'
        ];
        $this->view('paginas/sobre', $dados);
    }
}