<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">


<main class="main-content-inner">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="card-body">
					<h4 class="header-title">Candidatos</h4>
					<div class="data-tables datatable-dark">
						<table id="dataTable3" class="text-center">
							<thead class="text-capitalize">
								<tr>
									<th>Username</th>
									<th>E-mail</th>
									<th>Função</th>
									<th>Cadastrado em</th>
									<th>Permissões</th>
								</tr>
							</thead>
							<tbody>
								<?PHP foreach($admins as $admin): ?>
									<tr>
										<td><?PHP echo $admin['User']['username']; ?></td>
										<td><?PHP echo $admin['User']['email']; ?></td>
										<td><?PHP echo $admin['Role']['name']; ?></td>
										<td><?PHP echo $admin['User']['created']; ?></td>
										<td><?PHP echo $this->Html->link('Editar Permissão', array(
													'controller' => 'Users',
													'action' => 'admin_edit',
													$admin['User']['uuid'],
													));
												?>
										</td>
									</tr>
								<?PHP endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>