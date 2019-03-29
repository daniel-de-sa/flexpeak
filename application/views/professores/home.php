<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header');
?>
<br>
<div id="globalApp">

  <div class="container">
    <div class="row bg-light">
      <div class="col-sm-3 sidebar">
        <a class="btn btn-block btn-fp" href="<?php echo base_url();?>professores/post"><span class="oi oi-plus"></span> Novo Professor</a>
      </div>
      <div class="col-sm-9">

          <h3>Professores</h3>
         <?php if(isset($msg)){ echo $msg;}?>
         <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nome</th>
                <th>D. de nascimento</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
            <?php
                if($professores){
                  foreach($professores as $professor){
                      echo "<tr><td>{$professor->nome}</td><td>{$professor->data_nascimento}</td><td><a href=\"".base_url()."professores/put/{$professor->id_professor}\"><span title=\"Editar\" class=\"btn btn-primary oi oi-pencil\"></span></a> <span v-on:click=\"item = {$professor->id_professor}\"  data-toggle=\"modal\" data-target=\"#deleteModal\" title=\"Excluir\" class=\"btn btn-danger oi oi-trash\"></span></td></tr>";
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
        <button type="button" v-on:click="deleteItem('professores')" class="btn btn-danger">Excluir</button>
      </div>
    </div>
  </div>
  </div>
</div>
</div>
<?php
	$this->load->view('footer');
?>
