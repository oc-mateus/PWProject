<?php
require_once('functionsAdm.php');
view($_GET['id']);
include(HEADER_TEMPLATE);
?>

<h2>Gerente <?php echo $adms['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome / Razão Social:</dt>
	<dd><?php echo $adms['name']; ?></dd>

	<dt>Data de Nascimento:</dt>
	<dd><?php echo formatadata($adms['birthdate'], "d/m/Y"); ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Endereço:</dt>
	<dd><?php echo $adms['address']; ?></dd>

	<dt>Bairro:</dt>
	<dd><?php echo $adms['hood']; ?></dd>

	<dt>CEP:</dt>
	<dd><?php echo cep($adms['zip_code']); ?></dd>

	<dt>Data de Cadastro:</dt>
	<dd><?php echo formatadata($adms['created'], "d/m/Y - H:i:s"); ?></dd>

	<dt>Data da ultima atualização:</dt>
	<dd><?php echo formatadata($adms['modified'], "d/m/Y - H:i:s"); ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Cidade:</dt>
	<dd><?php echo $adms['city']; ?></dd>

	<dt>Telefone:</dt>
	<dd><?php echo celPhone($adms['phone']); ?></dd>

	<dt>Celular:</dt>
	<dd><?php echo telefone($adms['mobile']); ?></dd>

	<dt>UF:</dt>
	<dd><?php echo $adms['state']; ?></dd>

	<dt>Departamento:</dt>
	<dd><?php echo $adms['depto']; ?></dd>
</dl>

<td>
    <img src="<?php echo $adms['photo']?>" width="150" height="180px" />
</td>

<div id="actions" class="row mt-2">
	<div class="col-md-12">
		<a href="editAdm.php?id=<?php echo $adms['id']; ?>" class="btn btn-dark">Editar</a>
		<a href="index.php" class="btn btn-light">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
