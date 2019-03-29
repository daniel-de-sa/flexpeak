<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
  
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('CursosModel');
        $this->load->model('ProfessoresModel');
        $this->load->helper('functions_helper');
        $this->load->database();
	}

	//PAGINA INICIAL DAS FUNCOES DE CURSO
	public function index($page = null){
        $page['cursos'] = $this->CursosModel->getCursos();
		$this->load->view('cursos/home',$page);
    }

    //DELETA O CADASTRO DE UM CURSO
    public function delete(){
        $item = $this->uri->segment(3);
        if($item && is_numeric($item)){
            if($this->CursosModel->deleteCurso($item)){
                $page['msg'] = msgSucesso("Item removido com sucesso");
            }else{
                $page['msg'] = msgErro("Falha ao remover o item");
            }
        }else{
            $page['msg'] = msgErro("Item inválido");
        }
        $this->index($page);
    }
    

    //CADASTRA UM NOVO CURSO
    public function post(){
        $page['btn_title'] = "Cadastrar";
        $page['professores'] = $this->ProfessoresModel->getProfessores();
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
            $this->form_validation->set_rules('id_professor', 'Professor', 'required');
            if ($this->form_validation->run() == FALSE){
                $page['nome'] = $this->input->post('nome');
                $page['id_professor'] = $this->input->post('id_professor');
                $page['msg'] = msgErro(validation_errors());
                $this->load->view('cursos/formulario',$page);
            }else{
                if($this->CursosModel->postCurso()){
                    $page['msg'] = msgSucesso("Curso cadastrado com sucesso");
                    $this->index($page);
                }else{
                    $page['msg'] = msgErro("Falha ao adicionar novo curso");
                    $this->load->view('cursos/formulario',$page);
                }
            }
        }else{
            $this->load->view('cursos/formulario',$page);
        }
    }

    //EDITA UM CURSO
    public function put(){
        $item = $this->uri->segment(3);
        $page['professores'] = $this->ProfessoresModel->getProfessores();
        if($item && is_numeric($item) && $this->CursosModel->getCursos($item)){
            $page['btn_title'] = "Atualizar";
            $page['curso'] = $this->CursosModel->getCursos($item);
            $page['nome'] = $this->input->post() ?  $this->input->post('nome') : $page['curso']->nome;
            $page['id_professor'] = $this->input->post() ?  $this->input->post('id_professor') : $page['curso']->id_curso;
            if($this->input->post()){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
                $this->form_validation->set_rules('id_professor', 'Professor', 'required');
                if ($this->form_validation->run() == FALSE){
                    $page['msg'] = msgErro(validation_errors());
                    $this->load->view('cursos/formulario',$page);
                }else{
                    if($this->CursosModel->putCurso($item)){
                        $page['msg'] = msgSucesso("Atualização de dados do curso realizado com sucesso");
                        $this->index($page);
                    }else{
                        $page['msg'] = msgErro("Falha ao adicionar novo curso");
                        $this->load->view('cursos/formulario',$page);
                    }
                }
            }else{
                $this->load->view('cursos/formulario',$page);
            }
           
        }else{
            $page['msg'] = msgErro("Item inválido");
            $this->index($page);
        }
        
        
    }
}
