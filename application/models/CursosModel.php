<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CursosModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
    //obtem dados de todos os cursos ou de um curso especifico
	public function getCursos($value = null){
		$data = !$value ? $this->db->query("SELECT id_curso,nome,data_criacao FROM cursos")->result(): $this->db->query("SELECT id_curso,nome,data_criacao FROM cursos WHERE id_curso = ? LIMIT 1",$value)->row();
        $result = $data;
        if($result){
			return $result;
		}else{
			return false;
		}
    }

    //deleta o resgistro de um curso
    public function deleteCurso($value = null){
        if($value){
            //Verifica se o curso informado existe no banco
            $query =  $this->db->query("SELECT id_curso FROM cursos WHERE id_curso = $value");
            if($query->num_rows() >0){
                //atualiza o registro de alunos para um curso nulo 
            $this->db->query("UPDATE alunos SET id_curso = 0 WHERE id_curso = $value");
            return $this->db->query("DELETE FROM cursos WHERE id_curso = $value");
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    //Cadastra um novo curso
    public function postCurso(){
        $data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
        $data['data_criacao'] = date('Y-m-d');
        $data['id_professor'] = $this->input->post('id_professor');
        return ($this->db->query("INSERT INTO cursos (nome,data_criacao,id_professor) VALUES (?,?,?)",$data)) ? true : false;

    }

    //atualiza os dados de um Curso especifico
    public function putCurso($item){
        $data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
        $data['id_professor'] = $this->input->post('id_professor');
        return ($this->db->query("UPDATE cursos SET nome = ?, id_professor = ? WHERE id_curso = $item",$data)) ? true : false;

    }
}
