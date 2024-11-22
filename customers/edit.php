<?php 
require_once('functions.php'); 
edit();
session_start();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Atualizar Cliente</h2>
  <form action="edit.php?id=<?php echo $customer['id']; ?>" method="post" enctype="multipart/form-data">
    <hr class="mb-4">
    
    <!-- Informações Gerais -->
    <h5 class="mb-3">Informações Gerais</h5>
    <div class="row mb-3">
      <div class="form-group col-md-7">
        <label for="name">Nome / Razão Social</label>
        <input type="text" class="form-control" name="customer['name']" value="<?php echo $customer['name']; ?>" required>
      </div>
      <div class="form-group col-md-3">
        <label for="cpf_cnpj">CNPJ / CPF</label>
        <input type="text" class="form-control" name="customer['cpf_cnpj']" value="<?php echo $customer['cpf_cnpj']; ?>" maxlength="14" required>
      </div>
      <div class="form-group col-md-2">
        <label for="birthdate">Data de Nascimento</label>
        <input type="date" class="form-control" name="customer['birthdate']" value="<?php echo $customer['birthdate']; ?>" required>
      </div>
    </div>

    <!-- Endereço -->
    <h5 class="mb-3">Endereço</h5>
    <div class="row mb-3">
      <div class="form-group col-md-6">
        <label for="address">Endereço</label>
        <input type="text" class="form-control" name="customer['address']" value="<?php echo $customer['address']; ?>">
      </div>
      <div class="form-group col-md-3">
        <label for="hood">Bairro</label>
        <input type="text" class="form-control" name="customer['hood']" value="<?php echo $customer['hood']; ?>">
      </div>
      <div class="form-group col-md-3">
        <label for="zip_code">CEP</label>
        <input type="text" class="form-control" name="customer['zip_code']" value="<?php echo cep($customer['zip_code']); ?>" maxlength="8">
      </div>
    </div>

    <!-- Contato -->
    <h5 class="mb-3">Contato</h5>
    <div class="row mb-3">
      <div class="form-group col-md-4">
        <label for="city">Município</label>
        <input type="text" class="form-control" name="customer['city']" value="<?php echo $customer['city']; ?>">
      </div>
      <div class="form-group col-md-2">
        <label for="state">UF</label>
        <input type="text" class="form-control" name="customer['state']" value="<?php echo $customer['state']; ?>" maxlength="2">
      </div>
      <div class="form-group col-md-3">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control" name="celPhone(customer['phone'])" value="<?php echo $customer['phone']; ?>" maxlength="10">
      </div>
      <div class="form-group col-md-3">
        <label for="mobile">Celular</label>
        <input type="text" class="form-control" name="telefone(customer['mobile'])" value="<?php echo $customer['mobile']; ?>" maxlength="11">
      </div>
    </div>

    <!-- Informações Adicionais -->
    <h5 class="mb-3">Informações Adicionais</h5>
    <div class="row mb-3">
      <div class="form-group col-md-4">
        <label for="ie">Inscrição Estadual</label>
        <input type="text" class="form-control" name="customer['ie']" value="<?php echo $customer['ie']; ?>" maxlength="14">
      </div>
      <div class="form-group col-md-4">
        <label for="created">Data de Cadastro</label>
        <input type="text" class="form-control" name="customer['created']" value="<?php echo $customer['created']; ?>" disabled>
      </div>
    </div>

    <!-- Foto -->
    <h5 class="mb-3">Foto</h5>
    <div class="row mb-4">
      <div class="form-group col-md-6">
        <?php if (!empty($customer['photo'])): ?>
          <label>Foto Atual:</label><br>
          <img src="uploads/<?php echo $customer['photo']; ?>" alt="Foto Atual" class="img-thumbnail" style="max-width: 200px; max-height: 200px;"><br>
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
