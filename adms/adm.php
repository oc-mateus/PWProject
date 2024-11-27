<?php
require_once('functionsAdm.php');
view($_GET['id']);
session_start();
include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Gerente #<?php echo $adms['id']; ?></h2>
  <hr>

  <!-- Mensagem de Feedback -->
  <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>">
      <?php echo $_SESSION['message']; ?>
    </div>
  <?php endif; ?>

  <!-- Informações Pessoais -->
  <h5 class="mb-3">Informações Pessoais</h5>
  <dl class="row">
    <dt class="col-sm-3">Nome / Razão Social:</dt>
    <dd class="col-sm-9"><?php echo $adms['name']; ?></dd>

    <dt class="col-sm-3">Data de Nascimento:</dt>
    <dd class="col-sm-9"><?php echo formatadata($adms['birthdate'], "d/m/Y"); ?></dd>
  </dl>

  <!-- Endereço -->
  <h5 class="mb-3">Endereço</h5>
  <dl class="row">
    <dt class="col-sm-3">Endereço:</dt>
    <dd class="col-sm-9"><?php echo $adms['address']; ?></dd>

    <dt class="col-sm-3">Bairro:</dt>
    <dd class="col-sm-9"><?php echo $adms['hood']; ?></dd>

    <dt class="col-sm-3">CEP:</dt>
    <dd class="col-sm-9"><?php echo cep($adms['zip_code']); ?></dd>
  </dl>

  <!-- Datas -->
  <h5 class="mb-3">Datas</h5>
  <dl class="row">
    <dt class="col-sm-3">Data de Cadastro:</dt>
    <dd class="col-sm-9"><?php echo formatadata($adms['created'], "d/m/Y - H:i:s"); ?></dd>

    <dt class="col-sm-3">Última Atualização:</dt>
    <dd class="col-sm-9"><?php echo formatadata($adms['modified'], "d/m/Y - H:i:s"); ?></dd>
  </dl>

  <!-- Contato -->
  <h5 class="mb-3">Contato</h5>
  <dl class="row">
    <dt class="col-sm-3">Cidade:</dt>
    <dd class="col-sm-9"><?php echo $adms['city']; ?></dd>

    <dt class="col-sm-3">UF:</dt>
    <dd class="col-sm-9"><?php echo $adms['state']; ?></dd>

    <dt class="col-sm-3">Telefone:</dt>
    <dd class="col-sm-9"><?php echo celPhone($adms['phone']); ?></dd>

    <dt class="col-sm-3">Celular:</dt>
    <dd class="col-sm-9"><?php echo telefone($adms['mobile']); ?></dd>

    <dt class="col-sm-3">Departamento:</dt>
    <dd class="col-sm-9"><?php echo $adms['depto']; ?></dd>
  </dl>

  <!-- Foto -->
  <h5 class="mb-3">Foto</h5>
  <dl class="row">
    <dt class="col-sm-3">Foto Atual:</dt>
    <dd class="col-sm-9">
      <?php
      if (!empty($adms['photo'])) {
        echo "<img src=\"adms/imagens/" . $adms['photo'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
      } else {
        echo "<img src=\"adms/imagens/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
      }
      ?>
    </dd>
  </dl>

  <!-- Botões de Ação -->
  <div id="actions" class="row mt-4">
    <div class="col text-center">
      <a href="editAdm.php?id=<?php echo $adms['id']; ?>" class="btn btn-dark me-3"><i class="fa fa-pencil"></i> Editar</a>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </div>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
