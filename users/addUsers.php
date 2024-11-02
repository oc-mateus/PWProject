<?php 
  require_once('functionsUser.php'); 
  addUsers();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Usuário</h2>

<form action="addUsers.php" method="post">
  <!-- area de campos do form -->
  <hr />
 
  
  <div id="actions" class="row mt-2">
    <div class="col-md-12">
      <button type="submit" class="btn btn-dark">Salvar</button>
      <a href="index.php" class="btn btn-light">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>