<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header');
?>
<br>
<div class="container" id="app">
    <div class="row bg-light">
      <div class="col-sm-3 sidebar">
        <a class="btn btn-block btn-fp" href="<?php echo base_url();?>alunos"><span class="oi oi-chevron-left"></span> Voltar</a>
      </div>
      <div class="col-sm-9">
        <form class="col-md-10 offset-md-1" id="form_aluno" method="post" action="" v-on:submit.prevent="cadastroAluno">
        <h3>Alunos</h3>
        <?php if(isset($msg)){ echo $msg;}?>
            <div class="row" v-show="nao_encontrado">
                <div class="col-md-12 alert alert-danger">
                    {{msg_erro}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" value="<?php if(isset($nome))echo $nome;?>" name="nome" id="nome" required="" type="text"/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nascimento">Data de nascimento</label>
                    <input class="form-control" value="<?php if(isset($nascimento))echo $nascimento;?>" name="nascimento" required="" id="nascimento" type="date"/>
                  </div>
                </div>
              </div>
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="cep">CEP</label>
                    <input class="form-control" id="cep" name="cep" required="" type="text" v-model="cep"/>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="inputLogradouro">Logradouro</label>
                    <input class="form-control" id="inputLogradouro"  name="logradouro" type="text"  v-model="endereco.logradouro"/>
                  </div>
                </div>
              </div>
              <div class="row">
            <div class="col-md-9">
              <div class="form-group">
              <label for="bairro">Bairro</label>
              <input class="form-control" id="bairro" name="bairro" type="text" v-model="endereco.bairro"/>
              </div>
            </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="numero">Número</label>
                    <input class="form-control" name="numero" id="numero" value="<?php if(isset($numero))echo $numero;?>" type="number"/>
                  </div>
                </div>
                
              </div>
              
          <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input class="form-control" name="cidade" id="cidade" type="text" v-model="endereco.localidade"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <input class="form-control" id="estado" name="estado" type="text"  v-model="endereco.uf" maxlength="2"/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id_curso">Curso</label>
                    <select class="form-control" id="id_curso" name="id_curso" type="text">
                    <?php
									if($cursos){
										foreach($cursos as $curso){
											$selected = (isset($id_curso) && $curso->id_curso==$id_curso)?"selected":null;
											echo "<option value=\"{$curso->id_curso}\" $selected >{$curso->nome}</option>";
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
<script>
    var mixin = {
        data:{
           cep:'<?php if(isset($cep)){echo "$cep";}?>', 
            endereco:{
                <?php 
                    if(isset($logradouro)){echo "logradouro : '$logradouro',";}
                    if(isset($bairro)){echo "bairro : '$bairro',";}  
                    if(isset($cidade)){echo "localidade : '$cidade',";} 
                    if(isset($estado)){echo "uf : '$estado'";}             
                ?>
                
            }
        } 
    }
</script>
  
<?php
	$this->load->view('footer');
?>
