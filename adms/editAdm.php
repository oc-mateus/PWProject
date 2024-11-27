<?php 
require_once('functionsAdm.php'); 
editAdms();
session_start();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Atualizar Gerente</h2>
  
  <!-- Formulário de atualização -->
  <form action="editAdm.php?id=<?php echo $adms['id']; ?>" method="post" enctype="multipart/form-data">
    <hr class="mb-4">
    
    <!-- Dados Pessoais -->
    <h5 class="mb-3">Dados Pessoais</h5>
    <div class="row mb-3">
      <div class="form-group col-md-7">
        <label for="name">Nome / Razão Social</label>
        <input type="text" class="form-control" name="adms['name']" value="<?php echo $adms['name']; ?>" required>
      </div>
      <div class="form-group col-md-2">
        <label for="birthdate">Data de Nascimento</label>
        <input type="date" class="form-control" name="adms['birthdate']" value="<?php echo $adms['birthdate']; ?>" required>
      </div>
    </div>

    <!-- Endereço -->
    <h5 class="mb-3">Endereço</h5>
    <div class="row mb-3">
      <div class="form-group col-md-5">
        <label for="address">Endereço</label>
        <input type="text" class="form-control" name="adms['address']" value="<?php echo $adms['address']; ?>" >
      </div>
      <div class="form-group col-md-3">
        <label for="hood">Bairro</label>
        <input type="text" class="form-control" name="adms['hood']" value="<?php echo $adms['hood']; ?>" >
      </div>
      <div class="form-group col-md-2">
        <label for="zip_code">CEP</label>
        <input type="text" class="form-control" name="adms['zip_code']" value="<?php echo cep($adms['zip_code']); ?>" maxlength="8" >
      </div>
    </div>

    <!-- Contato -->
    <h5 class="mb-3">Contato</h5>
    <div class="row mb-3">
      <div class="form-group col-md-3">
        <label for="city">Município</label>
        <input type="text" class="form-control" name="adms['city']" value="<?php echo $adms['city']; ?>" >
      </div>
      <div class="form-group col-md-2">
        <label for="state">UF</label>
        <input type="text" class="form-control" name="adms['state']" value="<?php echo $adms['state']; ?>" maxlength="2" >
      </div>
      <div class="form-group col-md-3">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control" name="celPhone(adms['phone'])" value="<?php echo $adms['phone']; ?>" maxlength="10" >
      </div>
      <div class="form-group col-md-3">
        <label for="mobile">Celular</label>
        <input type="text" class="form-control" name="telefone(adms['mobile'])" value="<?php echo $adms['mobile']; ?>" maxlength="11" >
      </div>
    </div>

    <!-- Departamento -->
    <h5 class="mb-3">Departamento</h5>
    <div class="row mb-3">
      <div class="form-group col-md-3">
        <label for="depto">Departamento</label>
        <input type="text" class="form-control" name="adms['depto']" value="<?php echo $adms['depto']; ?>" required>
      </div>
      <div class="form-group col-md-3">
        <label for="created">Data de Cadastro</label>
        <input type="text" class="form-control" name="adms['created']" value="<?php echo $adms['created']; ?>" disabled>
      </div>
    </div>

    <!-- Foto -->
    <h5 class="mb-3">Foto</h5>
    <div class="row mb-4">
      <div class="form-group col-md-6">
        <?php if (!empty($adms['photo'])): ?>
          <label>Foto Atual:</label><br>
          <img src="adms/imagens/<?php echo $adms['photo']; ?>" alt="Foto Atual" class="img-thumbnail" style="max-width: 200px; max-height: 200px;"><br>
          <label for="photo" class="mt-2">Alterar Foto:</label>
        <?php else: ?>
          <label for="photo">Adicionar Foto:</label>
        <?php endif; ?>
        <input type="file" class="form-control" name="photo" id="photo">
      </div>
    </div>

    <!-- Botões de Ação -->
    <div class="row mt-4">
      <div class="col text-center">
        <button type="submit" class="btn btn-dark me-3"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
      </div>
    </div>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>

<script>
  // Pré-visualização da foto
  $(document).ready(() => {
    $('#photo').change(function() {
      const file = this.files[0];
      if (file) {
        let reader = new FileReader();
        reader.onload = function(event) {
          $('#imgPreview').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
      }
    });
  });
</script>
