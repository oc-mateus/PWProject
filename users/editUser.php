<?php 
require_once('functionsUser.php'); 
editUser();
session_start();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Atualizar Usuário</h2>
  <form action="editUser.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
    <hr class="mb-4">
    
    <!-- Informações do Usuário -->
    <h5 class="mb-3">Informações Gerais</h5>
    <div class="row mb-3">
      <div class="form-group col-md-8">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>" required>
      </div>
      <div class="form-group col-md-4">
        <label for="username">Usuário (Login)</label>
        <input type="text" class="form-control" name="usuario[user]" value="<?php echo $usuario['user']; ?>" required>
      </div>
    </div>

    <!-- Senha -->
    <h5 class="mb-3">Alteração de Senha</h5>
    <div class="row mb-3">
      <div class="form-group col-md-4">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="usuario[password]" value="" placeholder="Digite uma nova senha">
      </div>
    </div>

    <!-- Foto -->
    <h5 class="mb-3">Foto</h5>
    <div class="row mb-4">
      <div class="form-group col-md-6">
        <?php if (!empty($usuario['foto'])): ?>
          <label>Foto Atual:</label><br>
          <img src="users/fotos/<?php echo $usuario['foto']; ?>" alt="Foto Atual" class="img-thumbnail" style="max-width: 200px; max-height: 200px;"><br>
          <label for="foto" class="mt-2">Alterar Foto:</label>
        <?php else: ?>
          <label for="foto">Adicionar Foto:</label>
        <?php endif; ?>
        <input type="file" class="form-control" name="foto" id="foto">
      </div>
    </div>

    <!-- Ações -->
    <div id="actions" class="row mt-4">
      <div class="col text-center">
        <button type="submit" class="btn btn-dark me-3"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
        <a href="<?php echo BASEURL; ?>index.php" class="btn btn-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
      </div>
    </div>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>

<script>
  // Pré-visualização da foto
  $(document).ready(() => {
    $('#foto').change(function() {
      const file = this.files[0];
      if (file && file.type.match(/^image\//)) {
        let reader = new FileReader();
        reader.onload = function(event) {
          $('#imgPreview').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
      }
    });
  });
</script>
