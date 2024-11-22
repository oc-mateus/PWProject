<?php
require_once('functions.php');
view($_GET['id']);
session_start();
include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Cliente #<?php echo $customer['id']; ?></h2>
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
    <dt class="col-sm-3">Nome / Razão Social:</dt>
    <dd class="col-sm-9"><?php echo $customer['name']; ?></dd>

    <dt class="col-sm-3">CPF:</dt>
    <dd class="col-sm-9"><?php echo formatarCPF($customer['cpf_cnpj']); ?></dd>

    <dt class="col-sm-3">Data de Nascimento:</dt>
    <dd class="col-sm-9"><?php echo formatadata($customer['birthdate'], "d/m/Y"); ?></dd>
  </dl>

  <!-- Endereço -->
  <h5 class="mb-3">Endereço</h5>
  <dl class="row">
    <dt class="col-sm-3">Endereço:</dt>
    <dd class="col-sm-9"><?php echo $customer['address']; ?></dd>

    <dt class="col-sm-3">Bairro:</dt>
    <dd class="col-sm-9"><?php echo $customer['hood']; ?></dd>

    <dt class="col-sm-3">CEP:</dt>
    <dd class="col-sm-9"><?php echo cep($customer['zip_code']); ?></dd>
  </dl>

  <!-- Datas -->
  <h5 class="mb-3">Datas</h5>
  <dl class="row">
    <dt class="col-sm-3">Data de Cadastro:</dt>
    <dd class="col-sm-9"><?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?></dd>

    <dt class="col-sm-3">Última Atualização:</dt>
    <dd class="col-sm-9"><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></dd>
  </dl>

  <!-- Contato -->
  <h5 class="mb-3">Contato</h5>
  <dl class="row">
    <dt class="col-sm-3">Cidade:</dt>
    <dd class="col-sm-9"><?php echo $customer['city']; ?></dd>

    <dt class="col-sm-3">UF:</dt>
    <dd class="col-sm-9"><?php echo $customer['state']; ?></dd>

    <dt class="col-sm-3">Telefone:</dt>
    <dd class="col-sm-9"><?php echo celPhone($customer['phone']); ?></dd>

    <dt class="col-sm-3">Celular:</dt>
    <dd class="col-sm-9"><?php echo telefone($customer['mobile']); ?></dd>

    <dt class="col-sm-3">Inscrição Estadual:</dt>
    <dd class="col-sm-9"><?php echo $customer['ie']; ?></dd>
  </dl>

  <!-- Foto -->
  <h5 class="mb-3">Foto</h5>
  <dl class="dl-horizontal">
        <dd>
            <?php
            if (!empty($customer['photo'])) {
                echo "<img src=\"uploads/" . $customer['photo'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
            } else {
                echo "<img src=\"uploads/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
            }
            ?>
        </dd>
</dl>

  <!-- Botões de Ação -->
  <div id="actions" class="row mt-4">
    <div class="col text-center">
      <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-dark me-3"><i class="fa fa-pencil"></i> Editar</a>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </div>
  </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
