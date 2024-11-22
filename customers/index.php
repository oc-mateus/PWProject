<?php
include("functions.php");
index();
session_start();
include(HEADER_TEMPLATE);
?>

<div class="container mt-4">
	<header class="d-flex justify-content-between align-items-center mb-3">
		<h2>Clientes</h2>
		<div>
			<a class="btn btn-secondary me-2" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
			<a class="btn btn-light" href="index.php"><i class="fa-solid fa-rotate-right"></i> Atualizar</a>
		</div>
	</header>

	<!-- Barra de pesquisa -->
	<div class="row mb-4">
		<div class="col-sm-6">
			<form action="index.php" method="post">
				<div class="input-group">
					<input type="text" class="form-control" maxlength="50" name="customers" placeholder="Buscar cliente..." required>
					<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-search"></i></button>
				</div>
			</form>
		</div>
	</div>

	<!-- Mensagens de Alerta -->
	<?php if (!empty($_SESSION['message'])): ?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
			<?php echo $_SESSION['message']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php //clear_messages(); ?>
	<?php endif; ?>

	<!-- Tabela de Clientes -->
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th>ID</th>
				<th>Nome</th>
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
						<td>
							<?php 
							$data = new DateTime($customer['modified'], new DateTimeZone("America/Sao_Paulo"));
							echo $data->format("d/m/Y - H:i:s"); 
							?>
						</td>
						<td class="actions">
							<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal"
							   data="<?php echo $customer['id']; ?>">
								<i class="fa-solid fa-trash-can"></i> Excluir
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="6" class="text-center">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
