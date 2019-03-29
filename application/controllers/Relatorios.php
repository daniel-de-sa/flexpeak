<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller {
  
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('RelatoriosModel');
        $this->load->database();
        $this->load->library('Pdf');
	}


        
    public function index(){
     $page['relatorios'] = $this->RelatoriosModel->getRelatorios();
    $html =  $this->load->view('relatorios/home',$page,true);

   $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
     $pdf->SetCreator(PDF_CREATOR);
     $pdf->SetAuthor('Daniel de Sa');
     $pdf->SetTitle('Relatórios');
     $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     $pdf->SetCellPadding(0);
     
     // set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
     // set image scale factor
     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
     // set font
     $pdf->SetFont('times', 'BI', 12);
     
     // add a page
     $pdf->AddPage();
     
     // output the HTML content
     $pdf->writeHTML($html, true, false, false, false, '');
     
     // reset pointer to the last page
     $pdf->lastPage();
 
     //Close and output PDF document
     $pdf->Output('Relatorio_'.time().'.pdf', 'I');

     
    }
}