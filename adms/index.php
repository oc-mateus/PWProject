<?php
include("functionsAdm.php");
index();
include(HEADER_TEMPLATE);
?>

<header class="mt-4">
	<div class="row">
		<div class="col-sm-6">
			<h2>Gerentes</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-secondary" href="addAdm.php"><i class="fa-solid fa-user-plus"></i> Novo Gerente</a>
			<a class="btn btn-light" href="index.php"><i class="fa-solid fa-rotate-right"></i> Atualizar</a>
		</div>
	</div>
</header>

<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th width="30%">Nome</th>
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
					<?php $data = new DateTime(
						$adm['modified'],
						new DateTimeZone("America/Sao_Paulo")
					); ?>
					<td><?php echo $data->format("d/m/Y - H:i:s"); ?></td>
					<td class="actions text-right">
						<a href="adm.php?id=<?php echo $adm['id']; ?>" class="btn btn-sm btn-dark"><i
								class="fa fa-eye"></i> Visualizar</a>
						<a href="editAdm.php?id=<?php echo $adm['id']; ?>" class="btn btn-sm btn-secondary"><i
								class="fa fa-pencil"></i> Editar</a>
						<a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal"
							data="<?php echo $adm['id']; ?>">
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

<?php include('modalAdm.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
