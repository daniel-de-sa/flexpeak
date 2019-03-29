<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header');
?>
<br>
<div class="container">
    <div class="row bg-light">
      <div class="col-sm-3 sidebar">
        <a class="btn btn-block btn-fp" href="<?php echo base_url();?>cursos"><span class="oi oi-chevron-left"></span> Voltar</a>
      </div>
      <div class="col-sm-9">

         <form class="col-sm-10 offset-sm-1" method="post" action="">
			  <h3>Cursos</h3>
        <?php if(isset($msg)){ echo $msg;}?>
			  <div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label for="nome">Nome</label>
					  <input class="form-control" name="nome" value="<?php if(isset($nome))echo $nome;?>" id="nome" required="" type="text"/>
					</div>
				  </div>
					  <div class="col-md-6">
					<div class="form-group">
					  <label for="nascimento">Professor</label>
					  <select class="form-control" name="id_professor" required="">
								<?php
									if($professores){
										foreach($professores as $professor){
											$selected = (isset($id_professor) && $professor->id_professor==$id_professor)?"selected":null;
											echo "<option value=\"{$professor->id_professor}\" $selected >{$professor->nome}</option>";
										}
									}
								?>
						</select>
					</div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-3">
					<div class="form-group">
					  <input class="form-control btn btn-fp" type="submit" value="<?php echo $btn_title;?>"/>
					</div>
				  </div>
				</div>
			  </form>
      </div>
  </div>
</div>
  
<?php
	$this->load->view('footer');
?>
