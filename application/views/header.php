<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="author" content="Daniel de Sá"/>
	<meta name="description" content="Sistema web desenvolvido para o 
	processo seletivo referente a vaga de Programador JR pela FlexPeak"/>
	<title>FlexPeak</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico')?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/open-iconic-bootstrap.css')?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>"/>
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<a class="navbar-brand" href="<?php echo base_url();?>"><b>FLEXPEAK</b></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto text-center text-sm-right top-menu">
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url('alunos');?>"><span class="oi oi-people"></span> Alunos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('cursos');?>"><span class="oi oi-task"></span> Cursos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('professores');?>"><span class="oi oi-person"></span> Professores</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('relatorios');?>"><span class="oi oi-pie-chart"></span> Relatórios</a>
			</li>
			</ul>
		</div>
	</div>
	</nav>
	
  


