<?php 
  require_once('functionsAdm.php'); 
  addAdms();
  session_start();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Cadastrar Novo Gerente</h2>
  <form action="addAdm.php" method="post" enctype="multipart/form-data">
    <!-- Área de campos do formulário -->
    <hr class="mb-4">
    
    <!-- Primeira linha -->
    <div class="row mb-3">
      <div class="form-group col-md-7">
        <label for="name" class="form-label">Nome / Razão Social</label>
        <input type="text" class="form-control" name="adms['name']" placeholder="Digite o nome" required>
      </div>
      <div class="form-group col-md-3">
        <label for="birthdate" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" name="adms['birthdate']">
      </div>
    </div>
    
    <!-- Segunda linha -->
    <div class="row mb-3">
      <div class="form-group col-md-6">
        <label for="address" class="form-label">Endereço</label>
        <input type="text" class="form-control" name="adms['address']" placeholder="Digite o endereço">
      </div>
      <div class="form-group col-md-3">
        <label for="hood" class="form-label">Bairro</label>
        <input type="text" class="form-control" name="adms['hood']" placeholder="Digite o bairro">
      </div>
      <div class="form-group col-md-3">
        <label for="zip_code" class="form-label">CEP</label>
        <input type="text" class="form-control" name="adms['zip_code']" maxlength="8" placeholder="Somente números">
      </div>
    </div>
    
    <!-- Terceira linha -->
    <div class="row mb-3">
      <div class="form-group col-md-4">
        <label for="city" class="form-label">Município</label>
        <input type="text" class="form-control" name="adms['city']" placeholder="Digite o município">
      </div>
      <div class="form-group col-md-2">
        <label for="state" class="form-label">UF</label>
        <input type="text" class="form-control" name="adms['state']" maxlength="2" placeholder="Ex.: SP">
      </div>
      <div class="form-group col-md-3">
        <label for="phone" class="form-label">Telefone</label>
        <input type="text" class="form-control" name="adms['phone']" maxlength="10" placeholder="Somente números">
      </div>
      <div class="form-group col-md-3">
        <label for="mobile" class="form-label">Celular</label>
        <input type="text" class="form-control" name="adms['mobile']" maxlength="11" placeholder="Somente números">
      </div>
    </div>

    <!-- Quarta linha -->
    <div class="row mb-3">
      <div class="form-group col-md-6">
        <label for="depto" class="form-label">Departamento</label>
        <input type="text" class="form-control" name="adms['depto']" placeholder="Digite o departamento" required>
      </div>
      <div class="form-group col-md-6">
        <label for="photo" class="form-label">Foto</label>
        <input type="file" class="form-control" name="adms['photo']">
      </div>
    </div>
    
    <!-- Quinta linha -->
    <div class="row mb-3">
      <div class="form-group col-md-4">
        <label for="created" class="form-label">Data de Cadastro</label>
        <input type="text" class="form-control" name="adms['created']" placeholder="Automático" disabled>
      </div>
    </div>
    
    <!-- Ações -->
    <div id="actions" class="row">
      <div class="col text-center">
        <button type="submit" class="btn btn-dark me-3"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
      </div>
    </div>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
