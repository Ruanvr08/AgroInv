<?php 
class Estoque extends Database{

    private $db;

        public function __construct(){
            $this->db = new Database();
            

        }
        public function cadastrar( $quantidade, $validade,$nome, $unidade, $categoria){
            $this->db->query("INSERT INTO produtos( quantidade, validade, nome, unidade, categoria) VALUES (?, ?, ?, ?, ?)");
            $this->db->bind(1, $quantidade, \PDO::PARAM_INT); 
            $this->db->bind(2, $validade, \PDO::PARAM_STR);
            $this->db->bind(3, $nome, \PDO::PARAM_STR);
            $this->db->bind(4, $unidade, \PDO::PARAM_STR);
            $this->db->bind(5, $categoria, \PDO::PARAM_STR);
            $this->db->executa();
        }
        public function trazerProdutos(){
            $this->db->query("SELECT * FROM produtos");
            return $this->db->resultados();
        }
        public function trazerProdutosPeloId(){
            $this->db->query("SELECT * FROM produtos WHERE id = ?");
            $this->db->bind(1, $id, \PDO::PARAM_INT); 
            return $this->db->resultados();
        }
        public function editar($id,$quantidade, $validade,$nome, $unidade, $categoria){
            $this->db->query("UPDATE produtos SET quantidade=?, validade=?, nome=?, unidade=?, categoria=? WHERE id=?");
            $this->db->bind(1,$quantidade, \PDO::PARAM_STR);
            $this->db->bind(2,$validade, \PDO::PARAM_STR);
            $this->db->bind(3,$nome, \PDO::PARAM_STR);
            $this->db->bind(4,$unidade, \PDO::PARAM_STR);
            $this->db->bind(5,$categoria, \PDO::PARAM_STR);
            $this->db->bind(6,$id, \PDO::PARAM_INT);
            $this->db->executa();
    
        }
        public function deletar($id){
            $this->db->query("DELETE FROM produtos WHERE id = ?");
            $this->db->bind(1,$id, \PDO::PARAM_INT);
            $this->db->executa();
        }
        public function pesquisar($categoria) {
            $this->db->query("SELECT * FROM produtos WHERE categoria = ?");
            $this->db->bind(1, $categoria, \PDO::PARAM_STR);
            $this->db->executa();
            return $this->db->resultados(); 
        }
}