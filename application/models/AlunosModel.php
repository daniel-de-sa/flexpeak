<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlunosModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
    //obtem dados de todos os alunos ou de um aluno especifico
	public function getAlunos($value = null){
		$result = !$value ? $this->db->query("SELECT  nome, id_aluno, date_format(`data_nascimento`,'%d/%m/%Y') as `data_nascimento`,cep,logradouro,bairro,numero,cidade, estado,id_curso FROM alunos")->result(): $this->db->query("SELECT * FROM alunos WHERE id_aluno = ? LIMIT 1",$value)->row();
     
        if($result){
			return $result;
		}else{
			return false;
		}
    }

    //deleta o resgistro de um aluno
    public function deleteAluno($value = null){
        if($value){
            	return $this->db->query("DELETE FROM alunos WHERE id_aluno = $value");
        }else{
            return null;
        }
        
    }
    //Cadastra um novo aluno
    public function postAluno(){
		$data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
		$data['nascimento'] = $this->input->post('nascimento');
		$data['cep'] = $this->input->post('cep');
		$data['logradouro'] = $this->input->post('logradouro');
		$data['bairro'] = $this->input->post('bairro');
		$data['numero'] = $this->input->post('numero');
		$data['cidade'] = $this->input->post('cidade');
		$data['estado'] = $this->input->post('estado');
		$data['id_curso'] = $this->input->post('id_curso');
        $data['data_criacao'] = date('Y-m-d');
        return ($this->db->query("INSERT INTO alunos (nome,data_nascimento,cep,logradouro,bairro,numero,cidade, estado,id_curso,data_criacao) VALUES (?,?,?,?,?,?,?,?,?,?)",$data)) ? true : false;

    }

    //atualiza os dados de um Aluno especifico
    public function putAluno($item){
		$data['nome'] = ucwords(mb_strtolower($this->input->post('nome')));
		$data['nascimento'] = $this->input->post('nascimento');
		$data['cep'] = $this->input->post('cep');
		$data['logradouro'] = $this->input->post('logradouro');
		$data['bairro'] = $this->input->post('bairro');
		$data['numero'] = $this->input->post('numero');
		$data['cidade'] = $this->input->post('cidade');
		$data['estado'] = $this->input->post('estado');
		$data['id_curso'] = $this->input->post('id_curso');
        return ($this->db->query("UPDATE alunos SET nome = ?, data_nascimento = ? ,cep = ? ,logradouro = ? ,bairro = ? ,numero = ? ,cidade = ?, estado =? ,id_curso = ? WHERE id_aluno = $item",$data)) ? true : false;

    }
	
}
