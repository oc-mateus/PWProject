<?php
include("functions.php");
index();
include(HEADER_TEMPLATE);
?>

<header class="mt-2">
	<div class="row">
		<div class="col-sm-6">
			<h2>Clientes</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
			<a class="btn btn-light" href="index.php"><i class="fa-solid fa-rotate-right"></i> Atualizar</a>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<form action="index.php" method="post">
					<div class="row">
						<div class="form-group col-md-4">
							<div class="input-group mb-3">
								<input type="text" class="form-control" maxlenght="50" name="customers" required>
								<input type="submit" class="btn btn-secondary"><i class="fa-solid fa-search"> Consultar</i>
							</div>
						</div>
					</div>
				</form>
			</div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php //clear_messages(); ?>
<?php endif; ?>

<hr>
<!-- Tabela de Clientes -->
<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th width="30%">Nome</th>
			<th>CPF</th>
			<th>Telefone</th>
			<th>Atualizado em</th>
			<th>Opções</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($customers): ?>
			<?php foreach ($customers as $customer): ?>
				<tr>
					<td><?php echo $customer['id']; ?></td>
					<td><?php echo $customer['name']; ?></td>
					<td><?php echo formatarCPF($customer['cpf_cnpj']); ?></td>
					<td><?php echo celPhone($customer['phone']); ?></td>
					<?php $data = new DateTime(
						$customer['modified'],
						new DateTimeZone("America/Sao_Paulo")
					); ?>
					<td><?php echo $data->format("d/m/Y - H:i:s"); ?></td>
					<td class="actions text-right">
						<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-dark"><i
								class="fa fa-eye"></i> Visualizar</a>
						<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i
								class="fa fa-pencil"></i> Editar</a>
								<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal"
							data="<?php echo $customer['id']; ?>">
							<i class="fa-solid fa-trash-can"></i> Excluir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6">Nenhum registro encontrado.</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
