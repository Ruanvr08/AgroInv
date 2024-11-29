<?php

    class Post{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        public function lerPosts(){
            $this->db->query("SELECT *, posts.id_post as postId, posts.data_criacao as dataPost, usuario.id_usuario as usuarioId, usuario.data_criacao as dataUsuario FROM posts INNER JOIN usuario on posts.id_usuario = usuario.id_usuario ORDER BY posts.id_post DESC");
            return $this->db->resultados();
        }
        public function armazenar($dados){
            $this->db->query("INSERT INTO posts(id_usuario, titulo, texto) VALUES (:id_usuario, :titulo, :texto)");
            $this->db->bind(":id_usuario", $dados['id_usuario']);
            $this->db->bind(":titulo", $dados['titulo']);
            $this->db->bind(":texto", $dados['texto']);
            
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
        public function editar($dados){
            $this->db->query("UPDATE posts SET titulo = :titulo, texto = :texto WHERE id_post = :id_post");
            $this->db->bind(":id_post", $dados['id_post']);
            $this->db->bind(":titulo", $dados['titulo']);
            $this->db->bind(":texto", $dados['texto']);
            
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
        public function deletar($id){
            $this->db->query("DELETE FROM posts WHERE id_post = :id_post");
            $this->db->bind(":id_post", $id);
           
            if($this->db->executa()){
                return true;
            }else{
                return false;
            }
        }
        public function lerPostPorId($id){
            $this->db->query("SELECT * FROM posts WHERE id_post = :id_post");
            $this->db->bind('id_post', $id);
            return $this->db->resultado();
        }
    }