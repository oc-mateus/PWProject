<?php
require_once('functionsUser.php');
session_start();
view($_GET['id']);
include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Cliente #<?php echo $usuario['id']; ?></h2>
  <hr>

  <!-- Mensagem de Feedback -->
  <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
      <?php echo $_SESSION['message']; ?>
    </div>
  <?php endif; ?>

  <!-- Informações Gerais -->
  <h5 class="mb-3">Informações Gerais</h5>
  <dl class="row">
    <dt class="col-sm-3">Nome:</dt>
    <dd class="col-sm-9"><?php echo $usuario['nome']; ?></dd>

    <dt class="col-sm-3">Login:</dt>
    <dd class="col-sm-9"><?php echo $usuario['user']; ?></dd>

    <dt class="col-sm-3">Senha:</dt>
    <dd class="col-sm-9"><?php echo $usuario['password']; ?></dd>
  </dl>

  <!-- Foto -->
  <h5 class="mb-3">Foto</h5>
  <dl class="dl-horizontal">
    <dd>
      <?php
      if (!empty($usuario['foto'])) {
          echo "<img src=\"users/fotos/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
      } else {
          echo "<img src=\"users/fotos/semimagem.png\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
      }
      ?>
    </dd>
  </dl>

  <!-- Botões de Ação -->
  <div id="actions" class="row mt-4">
    <div class="col text-center">
      <?php if (empty($_SESSION['message'])): ?>
        <a href="editUser.php?id=<?php echo $usuario['id']; ?>" class="btn btn-dark me-3"><i class="fa fa-pencil"></i> Editar</a>
      <?php endif; ?>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </div>
  </div>
</div>

<?php clear_messages(); ?>
<?php include(FOOTER_TEMPLATE); ?>
