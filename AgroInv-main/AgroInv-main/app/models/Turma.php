<?php 


class Turma{
    private $db;
    public function __construct(){
        $this->db = new Database; 
    }
    public function checarNomeTurma($nome_turma){
        $this->db->query("SELECT nome_turma FROM turmas WHERE nome_turma = :nome_turma");
        $this->db->bind(":nome_turma", $nome_turma);
    
        if($this->db->resultado()){
            return true; // Turma com o mesmo nome já existe
        } else {
            return false; // Turma com o mesmo nome não existe
        }
    }
    public function armazenar($dados){
        $this->db->query("INSERT INTO turmas(nome_turma,  quantidade_alunos, ano_ingresso) VALUES (:nome_turma, :quantidade_alunos, :ano_ingresso)");
        $this->db->bind(":nome_turma", $dados['nome_turma']);
        $this->db->bind(":quantidade_alunos", $dados['quantidade_alunos']);
        $this->db->bind(":ano_ingresso", $dados['ano_ingresso']);
    
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
    
    public function lerTurmaPorId($id){
        $this->db->query("SELECT * FROM turmas WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->resultado();
    }  
    public function lerTurmas(){
        $this->db->query("SELECT * FROM turmas ");
        return $this->db->resultados();
    }
    public function deletar($id){
        $this->db->query("DELETE FROM turmas WHERE id= :id");
        $this->db->bind(":id", $id);
       
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
    public function editar($dados){
        $this->db->query("UPDATE turmas SET nome_turma = :nome_turma, quantidade_alunos=:quantidade_alunos, ano_ingresso = :ano_ingresso WHERE id = :id");
        $this->db->bind(":id", $dados['id']);
        $this->db->bind(":nome_turma", $dados['nome_turma']);
        $this->db->bind(":quantidade_alunos", $dados['quantidade_alunos']);
        $this->db->bind(":ano_ingresso", $dados['ano_ingresso']);
        
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
}