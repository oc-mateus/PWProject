<?php
include("functionsAdm.php");
index();
session_start();
include(HEADER_TEMPLATE);
?>

<div class="container mt-4">
	<header class="d-flex justify-content-between align-items-center mb-3">
		<h2>Gerentes</h2>
		<div>
			<a class="btn btn-secondary me-2" href="addAdm.php"><i class="fa-solid fa-user-plus"></i> Novo Gerente</a>
			<a class="btn btn-light" href="index.php"><i class="fa-solid fa-rotate-right"></i> Atualizar</a>
		</div>
	</header>

	<!-- Barra de pesquisa -->
	<div class="row mb-4">
		<div class="col-sm-6">
			<form action="index.php" method="post">
				<div class="input-group">
					<input type="text" class="form-control" maxlength="50" name="adms" placeholder="Buscar gerente..." required>
					<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-search"></i></button>
				</div>
			</form>
		</div>
	</div>

	<!-- Tabela de Gerentes -->
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Departamento</th>
				<th>Atualizado em</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($adms): ?>
				<?php foreach ($adms as $adm): ?>
					<tr>
						<td><?php echo $adm['id']; ?></td>
						<td><?php echo $adm['name']; ?></td>
						<td><?php echo celPhone($adm['phone']); ?></td>
						<td><?php echo $adm['depto']; ?></td>
						<td>
							<?php 
							$data = new DateTime($adm['modified'], new DateTimeZone("America/Sao_Paulo"));
							echo $data->format("d/m/Y - H:i:s"); 
							?>
						</td>
						<td class="actions text-center">
							<a href="adm.php?id=<?php echo $adm['id']; ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="editAdm.php?id=<?php echo $adm['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="<?php echo $adm['id']; ?>">
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

<?php include('modalAdm.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
