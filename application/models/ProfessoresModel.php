<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfessoresModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
    //obtem dados de todos os professores ou de um professor especifico
	public function getProfessores($value = null){
		$data = !$value ? $this->db->query("SELECT id_professor,nome, date_format(`data_nascimento`,'%d/%m/%Y') as `data_nascimento`,data_criacao FROM professores")->result(): $this->db->query("SELECT id_professor,nome,data_nascimento,data_criacao FROM professores WHERE id_professor = ? LIMIT 1",$value)->row();
        $result = $data;
        if($result){
			return $result;
		}else{
			return false;
		}
    }

    //deleta o resgistro de um professor
    public function deleteProfessor($value = null){
        if($value){
            //Verifica se o professor informado existe no banco
            $query =  $this->db->query("SELECT id_professor FROM professores WHERE id_professor = $value");
            if($query->num_rows() >0){
                //atualiza o registro de cursos para um professor nulo 
            $this->db->query("UPDATE cursos SET id_professor = 0 WHERE id_professor = $value");
            return $this->db->query("DELETE FROM professores WHERE id_professor = $value");
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    //Cadastra um novo professor
    public function postProfessor(){
        $data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
        $data['data_criacao'] = date('Y-m-d');
        $data['nascimento'] = $this->input->post('nascimento');
        return ($this->db->query("INSERT INTO professores (nome,data_criacao,data_nascimento) VALUES (?,?,?)",$data)) ? true : false;

    }

    //atualiza os dados de um Professor especifico
    public function putProfessor($item){
        $data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
        $data['nascimento'] = $this->input->post('nascimento');
        return ($this->db->query("UPDATE professores SET nome = ?, data_nascimento = ? WHERE id_professor = $item",$data)) ? true : false;

    }
}
