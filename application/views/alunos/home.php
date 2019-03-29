<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header');
?>
<br>


  <div class="container" id="globalApp">
    <div class="row bg-light">
      <div class="col-sm-3 sidebar">
        <a class="btn btn-block btn-fp" href="<?php echo base_url();?>alunos/post"><span class="oi oi-plus"></span> Novo Aluno</a>
      </div>
      <div class="col-sm-9">

          <h3>Alunos</h3>
         <?php if(isset($msg)){ echo $msg;}?>
         <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>D. de nascimento</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
            <?php
                if($alunos){
                  foreach($alunos as $aluno){
                      echo "<tr><td>{$aluno->id_aluno}</td><td>{$aluno->nome}</td><td>{$aluno->data_nascimento}</td><td><a href=\"".base_url()."alunos/put/{$aluno->id_aluno}\"><span title=\"Editar\" class=\"btn btn-primary oi oi-pencil\"></span></a> <span v-on:click=\"item = {$aluno->id_aluno}\"  data-toggle=\"modal\" data-target=\"#deleteModal\" title=\"Excluir\" class=\"btn btn-danger oi oi-trash\"></span></td></tr>";
                  }
                }else{
                  echo "<tr><td>Sem registros</td></tr>";
                }
            ?>
            </tbody>
          </table>
      </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                Deseja mesmo excluir este item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" v-on:click="deleteItem('alunos')" class="btn btn-danger">Excluir</button>
      </div>
    </div>
  </div>
  </div>
</div>
<?php
	$this->load->view('footer');
?>
