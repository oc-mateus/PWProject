<?php 
require_once('functionsAdm.php'); 
editAdms();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Atualizar Gerente</h2>

<!-- Adiciona enctype para permitir o envio de arquivos -->
<form action="editAdm.php?id=<?php echo $adms['id']; ?>" method="post" enctype="multipart/form-data">
  <hr />
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Nome / Razão Social</label>
      <input type="text" class="form-control" name="adms['name']" value="<?php echo $adms['name']; ?>">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Data de Nascimento</label>
      <input type="date" class="form-control" name="adms['birthdate']" value="<?php echo $adms['birthdate']; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-5">
      <label for="campo1">Endereço</label>
      <input type="text" class="form-control" name="adms['address']" value="<?php echo $adms['address']; ?>">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Bairro</label>
      <input type="text" class="form-control" name="adms['hood']" value="<?php echo $adms['hood']; ?>">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">CEP</label>
      <input type="text" class="form-control" name="adms['zip_code']" value="<?php echo cep($adms['zip_code']); ?>" maxlength="8">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="text" class="form-control" name="adms['created']" disabled value="<?php echo $adms['created']; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo1">Município</label>
      <input type="text" class="form-control" name="adms['city']" value="<?php echo $adms['city']; ?>">
    </div>

    <div class="form-group col-md-2">
      <label for="campo2">Telefone</label>
      <input type="text" class="form-control" name="adms['phone']" value="<?php echo $adms['phone']; ?>" maxlength="10">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Celular</label>
      <input type="text" class="form-control" name="adms['mobile']" value="<?php echo $adms['mobile']; ?>" maxlength="11">
    </div>

    <div class="form-group col-sm-1">
      <label for="campo3">UF</label>
      <input type="text" class="form-control" name="adms['state']" value="<?php echo $adms['state']; ?>" maxlength="2">
    </div>

    <div class="form-group col-md-3"> 
      <label for="campo2">Departamento</label>
      <input type="text" class="form-control" name="adms['depto']"  value="<?php echo $adms['depto']; ?>" required>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-6">
      <label for="photo">Foto Atual:</label><br>
      <?php if (!empty($adms['photo'])): ?>
        <img src="fotos/<?php echo $adms['photo']; ?>" alt="Foto Atual" style="max-width: 200px; max-height: 200px;"><br>
        <label for="change_photo">Alterar Foto:</label>
      <?php else: ?>
        <p>Sem foto disponível.</p>
        <label for="photo">Adicionar Foto:</label>
      <?php endif; ?>
      <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="form-group col-md-2">
      <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo !empty($adms['photo']) ? $adms['photo'] : 'semimagem.jpg'; ?>" alt="Pré-visualização" width="200px">
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

<script>
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
