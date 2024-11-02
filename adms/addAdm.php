<?php 
  require_once('functionsAdm.php'); 
  addAdms();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Gerente</h2>

<form action="addAdm.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="adms['name']" required>
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="adms['birthdate']">
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="adms['address']">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Bairro</label>
      <input type="text" class="form-control" name="adms['hood']">
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">CEP</label>
      <input type="text" class="form-control" name="adms['zip_code']" maxlength="8">
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="text" class="form-control" name="adms['created']" disabled>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo1">Município</label>
      <input type="text" class="form-control" name="adms['city']">
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo2">Telefone</label>
      <input type="text" class="form-control" name="celPhone(adms['phone'])" maxlength="10">
    </div>
    
    <div class="form-group col-md-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="telefone(adms['mobile'])" maxlength="11">
    </div>
    
    <div class="form-group col-md-1">
      <label for="campo3">UF</label>
      <input type="text" class="form-control" name="adms['state']" maxlength="2">
    </div>
    
    <div class="form-group col-md-3"> 
      <label for="campo2">Departamento</label>
      <input type="text" class="form-control" name="adms['depto']" required>
    </div>

    <div class="form-group col-md-5">
      <label for="campo2">Foto</label>
      <input type="file" name="adms['photo']" class="form-control">
    </div>
  </div>

    
  </div>
  
  <div id="actions" class="row mt-2">
    <div class="col-md-12">
      <button type="submit" class="btn btn-dark">Salvar</button>
      <a href="index.php" class="btn btn-light">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>