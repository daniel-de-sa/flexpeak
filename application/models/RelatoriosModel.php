<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatoriosModel extends CI_Model {
	public function __construct(){
		parent::__construct();
    }

    public function getRelatorios(){
        return $this->db->query("SELECT alunos.nome as aluno, cursos.nome as curso, professores.nome as professor FROM alunos INNER JOIN cursos  INNER JOIN professores ON cursos.id_professor = professores.id_professor")->result();
    }
}