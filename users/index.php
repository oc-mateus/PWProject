<?php
include("functionsUser.php");
index();
session_start();
include(HEADER_TEMPLATE);
?>

<div class="container mt-4">
	<header class="d-flex justify-content-between align-items-center mb-3">
		<h2>Usuários</h2>
		<div>
			<a class="btn btn-secondary me-2" href="addUsers.php"><i class="fa-solid fa-user-gear"></i> Novo Usuário</a>
			<a class="btn btn-light" href="index.php"><i class="fa-solid fa-rotate-right"></i> Atualizar</a>
		</div>
	</header>

	<!-- Barra de pesquisa -->
	<div class="row mb-4">
		<div class="col-sm-6">
			<form action="index.php" method="post">
				<div class="input-group">
					<input type="text" class="form-control" maxlength="50" name="users" placeholder="Buscar usuário..." required>
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

	<!-- Tabela de Usuários -->
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Login</th>
				<th>Foto</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($usuarios): ?>
				<?php foreach ($usuarios as $usuario): ?>
					<tr>
						<td><?php echo $usuario['id']; ?></td>
						<td><?php echo $usuario['nome']; ?></td>
						<td><?php echo $usuario['user']; ?></td>
						<td>
							<?php if (!empty($usuario['foto'])): ?>
								<img src="users/fotos/<?php echo $usuario['foto']; ?>" alt="Foto do Usuário" class="img-thumbnail" style="max-width: 50px;">
							<?php else: ?>
								<img src="users/fotos/semimagem.png" alt="Sem Foto" class="img-thumbnail" style="max-width: 50px;">
							<?php endif; ?>
						</td>
						<td class="actions">
							<a href="user.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="editUser.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal" data="<?php echo $usuario['id']; ?>">
								<i class="fa-solid fa-trash-can"></i> Excluir
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="5" class="text-center">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
