<?php

    class Usuario{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        public function checarEmail($email){
            $this->db->query("SELECT email_usuario from usuario WHERE email_usuario = :email_usuario");
            $this->db->bind(":email_usuario", $email);

            if($this->db->resultado()){
                return true; // email ja cadastrado
            }else{
                return false; // email nao foi cadastrado
            }
        }
        public function armazenar($dados){
            $this->db->query("INSERT INTO usuario(nome_usuario, tipo_usuario, email_usuario, senha_usuario) VALUES (:nome_usuario,:tipo_usuario, :email_usuario, :senha_usuario)");
            $this->db->bind(":nome_usuario", $dados['nome']);
            $this->db->bind(":tipo_usuario", $dados['tipo_usuario']);
            $this->db->bind(":email_usuario", $dados['email']);
            $this->db->bind(":senha_usuario", $dados['senha']);
            
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
        public function checarLogin($email, $senha){
            $this->db->query("SELECT * from usuario WHERE email_usuario = :email_usuario");
            $this->db->bind(":email_usuario", $email);

            if($this->db->resultado()){
                $resultado = $this->db->resultado();
                if(password_verify($senha, $resultado->senha_usuario)){
                    return $resultado;
                }else{
                return false;
                }   
            }else{
                return false;
            }
        }
        public function lerUsuarioPorId($id){
            $this->db->query("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
            $this->db->bind('id_usuario', $id);
            return $this->db->resultado();
        }
        public function lerProfessores(){
            $this->db->query("SELECT * FROM usuario WHERE tipo_usuario = 'professor' ");
            return $this->db->resultados();
        }
        public function deletar($id){
            $this->db->query("DELETE FROM usuario WHERE id_usuario= :id_usuario");
            $this->db->bind(":id_usuario", $id);
           
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
        public function editar($dados){
            $this->db->query("UPDATE usuario SET nome_usuario = :nome_usuario, email_usuario = :email_usuario WHERE id_usuario = :id_usuario");
            $this->db->bind(":id_usuario", $dados['id_usuario']);
            $this->db->bind(":nome_usuario", $dados['nome_usuario']);
            $this->db->bind(":email_usuario", $dados['email_usuario']);
            
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
    }