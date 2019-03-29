<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Controller {
  
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('AlunosModel');
        $this->load->model('CursosModel');
        $this->load->helper('functions_helper');
        $this->load->database();
	}

	//PAGINA INICIAL DAS FUNCOES DE ALUNO
	public function index($page = null){
        $page['alunos'] = $this->AlunosModel->getAlunos();
		    $this->load->view('alunos/home',$page);
    }

    //DELETA O CADASTRO DE UM ALUNO
    public function delete(){
        $item = $this->uri->segment(3);
        if($item && is_numeric($item)){
            if($this->AlunosModel->deleteAluno($item)){
                $page['msg'] = msgSucesso("Item removido com sucesso");
            }else{
                $page['msg'] = msgErro("Falha ao remover o item");
            }
        }else{
            $page['msg'] = msgErro("Item inválido");
        }
        $this->index($page);
    }
    

    //CADASTRA UM NOVO ALUNO
    public function post(){
        $page['btn_title'] = "Cadastrar";
        $page['cursos'] = $this->CursosModel->getCursos();
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
            $this->form_validation->set_rules('nascimento', 'Data de nascimento', 'required|trim');
            $this->form_validation->set_rules('cep', 'CEP', 'required|trim');
            $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|trim');
            $this->form_validation->set_rules('bairro', 'Bairro', 'required|trim');
            $this->form_validation->set_rules('numero', 'Número', 'required|trim|numeric');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim');
            $this->form_validation->set_rules('estado', 'Estado', 'required|trim');
            $this->form_validation->set_rules('id_curso', 'Curso', 'required');
            if ($this->form_validation->run() == FALSE){
                $page['nome'] = $this->input->post('nome');
                $page['nascimento'] = $this->input->post('nascimento');
                $page['cep'] = $this->input->post('cep');
                $page['logradouro'] = $this->input->post('logradouro');
                $page['bairro'] = $this->input->post('bairro');
                $page['numero'] = $this->input->post('numero');
                $page['cidade'] = $this->input->post('cidade');
                $page['estado'] = $this->input->post('estado');
                $page['id_curso'] = $this->input->post('id_curso');
                $page['msg'] = msgErro(validation_errors());
                $this->load->view('alunos/formulario',$page);
            }else{
                if($this->AlunosModel->postAluno()){
                    $page['msg'] = msgSucesso("Aluno cadastrado com sucesso");
                    $this->index($page);
                }else{
                    $page['msg'] = msgErro("Falha ao adicionar novo curso");
                    $this->load->view('alunos/formulario',$page);
                }
            }
        }else{
            $this->load->view('alunos/formulario',$page);
        }
    }

    //EDITA UM ALUNO
    public function put(){
        $item = $this->uri->segment(3);
        $page['cursos'] = $this->CursosModel->getCursos();
        if($item && is_numeric($item) && $this->AlunosModel->getAlunos($item)){
            $page['btn_title'] = "Atualizar";
            $page['aluno'] = $this->AlunosModel->getAlunos($item);
            $page['nome'] = $this->input->post() ?  $this->input->post('nome') : $page['aluno']->nome;
            $page['nascimento'] = $this->input->post() ? $this->input->post('nascimento') : $page['aluno']->data_nascimento;
            $page['cep'] = $this->input->post() ? $this->input->post('cep') : $page['aluno']->cep;
            $page['logradouro'] = $this->input->post() ? $this->input->post('logradouro') : $page['aluno']->logradouro;
            $page['bairro'] = $this->input->post() ? $this->input->post('bairro') : $page['aluno']->bairro;
            $page['numero'] = $this->input->post() ?  $this->input->post('numero') : $page['aluno']->numero;
            $page['cidade'] = $this->input->post() ? $this->input->post('cidade') : $page['aluno']->cidade;
            $page['estado'] = $this->input->post() ? $this->input->post('estado') : $page['aluno']->estado;
            $page['id_curso'] = $this->input->post() ? $this->input->post('id_curso') : $page['aluno']->id_curso;
            if($this->input->post()){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nome', 'Nome', 'required|trim');
                $this->form_validation->set_rules('nascimento', 'Data de nascimento', 'required|trim');
                $this->form_validation->set_rules('cep', 'CEP', 'required|trim');
                $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|trim');
                $this->form_validation->set_rules('bairro', 'Bairro', 'required|trim');
                $this->form_validation->set_rules('numero', 'Número', 'required|trim|numeric');
                $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim');
                $this->form_validation->set_rules('estado', 'Estado', 'required|trim');
                $this->form_validation->set_rules('id_curso', 'Curso', 'required');
                if ($this->form_validation->run() == FALSE){
                    $page['msg'] = msgErro(validation_errors());
                    $this->load->view('alunos/formulario',$page);
                }else{
                    if($this->AlunosModel->putAluno($item)){
                        $page['msg'] = msgSucesso("Atualização de dados do curso realizado com sucesso");
                        $this->index($page);
                    }else{
                        $page['msg'] = msgErro("Falha ao adicionar novo curso");
                        $this->load->view('alunos/formulario',$page);
                    }
                }
            }else{
                $this->load->view('alunos/formulario',$page);
            }
           
        }else{
            $page['msg'] = msgErro("Item inválido");
            $this->index($page);
        }
        
        
    }
    
}
