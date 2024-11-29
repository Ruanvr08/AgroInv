<?php 
class Calendario extends Database{

    private $db;
   

        public function __construct(){
            $this->db = new Database();
            

        }
    
    public function trazerEventos(){
        $this->db->query("SELECT
        id_evento AS id,
        titulo_evento AS title,
        descricao_evento AS `description`,
        comeco_evento AS `start`,
        fim_evento AS `end`,
        link_aula AS `docs`
    FROM eventos;");
        $this->db->executa();
        $resultados=$this->db->resultados(\PDO::FETCH_ASSOC);
        return json_encode($resultados);
    }
    public function criarEvento($id=0,$id_user=0, $title,$description, $start, $end, $prof, $lab, $turma,$docs){
        $this->db->query("INSERT INTO eventos(id_evento, id_usuario, titulo_evento, descricao_evento, comeco_evento, fim_evento, professor_evento, lab_evento, turma_evento, link_aula) values(?,?,?,?,?,?,?,?,?,?)");

        $this->db->bind(1,$id, \PDO::PARAM_INT);
        $this->db->bind(2,$id_user, \PDO::PARAM_INT);
        $this->db->bind(3,$title, \PDO::PARAM_STR);
        $this->db->bind(4,$description, \PDO::PARAM_STR);
        $this->db->bind(5,$start, \PDO::PARAM_STR);
        $this->db->bind(6,$end, \PDO::PARAM_STR);
        $this->db->bind(7,$prof, \PDO::PARAM_STR);
        $this->db->bind(8,$lab, \PDO::PARAM_STR);
        $this->db->bind(9,$turma, \PDO::PARAM_STR);
        $this->db->bind(10,$docs, \PDO::PARAM_STR);
        $this->db->executa();

    }
    public function trazerEventosPeloId($id){
        $this->db->query("SELECT * FROM eventos WHERE id_evento=?");
        $this->db->bind(1, $id, \PDO::PARAM_INT);
        $this->db->executa();
        return $this->db->resultados(\PDO::FETCH_OBJ);
    }
    
    public function atualizarEvento($id, $title,$description, $start, $end, $turma, $prof, $lab, $docs){
        $this->db->query("UPDATE eventos SET titulo_evento=?, descricao_evento=?, comeco_evento=?, fim_evento=?,turma_evento=?,professor_evento=?, lab_evento=?, link_aula=? WHERE id_evento=?");
        $this->db->bind(1,$title, \PDO::PARAM_STR);
        $this->db->bind(2,$description, \PDO::PARAM_STR);
        $this->db->bind(3,$start, \PDO::PARAM_STR);
        $this->db->bind(4,$end, \PDO::PARAM_STR);
        $this->db->bind(5,$turma, \PDO::PARAM_STR);
        $this->db->bind(6,$prof, \PDO::PARAM_STR);
        $this->db->bind(7,$lab, \PDO::PARAM_STR);
        $this->db->bind(8,$docs, \PDO::PARAM_STR);
        $this->db->bind(9,$id, \PDO::PARAM_INT);
        
        $this->db->executa();

    }
    public function deletarEvento($id){
        $this->db->query("DELETE FROM eventos WHERE id_evento=?");
        $this->db->bind(1,$id, \PDO::PARAM_INT);
        $this->db->executa();

    }
    public function lerEventos(){
        $this->db->query("SELECT * FROM eventos");
        return $this->db->resultados();
    }
    public function trazerIdCriador($id){
            $this->db->query("SELECT id_usuario from eventos where id_evento = :id");
            $this->db->bind(':id', $id);
            $this->db->executa();
            return $this->db->resultado();
        }
        
           
}










