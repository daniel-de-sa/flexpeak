<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professores extends CI_Controller {
  
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('ProfessoresModel');
        $this->load->helper('functions_helper');
        $this->load->database();
	}

	//PAGINA INICIAL DAS FUNCOES DE PROFESSOR
	public function index($page = null){
        $page['professores'] = $this->ProfessoresModel->getProfessores();
		$this->load->view('professores/home',$page);
    }

    //DELETA O CADASTRO DE UM PROFESSOR
    public function delete(){
        $item = $this->uri->segment(3);
        if($item && is_numeric($item)){
            if($this->ProfessoresModel->deleteProfessor($item)){
                $page['msg'] = msgSucesso("Item removido com sucesso");
            }else{
                $page['msg'] = msgErro("Falha ao remover o item");
            }
        }else{
            $page['msg'] = msgErro("Item inválido");
        }
        $this->index($page);
    }
    

    //CADASTRA UM NOVO PROFESSOR
    public function post(){
        $page['btn_title'] = "Cadastrar";
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
            $this->form_validation->set_rules('nascimento', 'Data de nascimento', 'required');
            if ($this->form_validation->run() == FALSE){
                $page['nome'] = $this->input->post('nome');
                $page['nascimento'] = $this->input->post('nascimento');
                $page['msg'] = msgErro(validation_errors());
                $this->load->view('professores/formulario',$page);
            }else{
                if($this->ProfessoresModel->postProfessor()){
                    $page['msg'] = msgSucesso("Professor cadastrado com sucesso");
                    $this->index($page);
                }else{
                    $page['msg'] = msgErro("Falha ao adicionar novo professor");
                    $this->load->view('professores/formulario',$page);
                }
            }
        }else{
            $this->load->view('professores/formulario',$page);
        }
    }

    //EDITA UM PROFESSOR
    public function put(){
        $item = $this->uri->segment(3);
        if($item && is_numeric($item) && $this->ProfessoresModel->getProfessores($item)){
            $page['btn_title'] = "Atualizar";
            $page['professor'] = $this->ProfessoresModel->getProfessores($item);
            $page['nome'] = $this->input->post() ?  $this->input->post('nome') : $page['professor']->nome;
            $page['nascimento'] = $this->input->post() ?  $this->input->post('nascimento') : $page['professor']->data_nascimento;
            if($this->input->post()){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
                $this->form_validation->set_rules('nascimento', 'Data de nascimento', 'required');
                if ($this->form_validation->run() == FALSE){
                    $page['msg'] = msgErro(validation_errors());
                    $this->load->view('professores/formulario',$page);
                }else{
                    if($this->ProfessoresModel->putProfessor($item)){
                        $page['msg'] = msgSucesso("Atualização de dados do professor realizado com sucesso");
                        $this->index($page);
                    }else{
                        $page['msg'] = msgErro("Falha ao adicionar novo professor");
                        $this->load->view('professores/formulario',$page);
                    }
                }
            }else{
                $this->load->view('professores/formulario',$page);
            }
           
        }else{
            $page['msg'] = msgErro("Item inválido");
            $this->index($page);
        }
        
        
    }
}
