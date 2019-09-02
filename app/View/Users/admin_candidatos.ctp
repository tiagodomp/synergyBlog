<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">


<div class="col-12 mt-5">
	<div class="card">
		<div class="card-body">
			<h4 class="header-title">Usuários Bloqueados</h4>
			<div class="data-tables datatable-dark">
				<table id="dataTable3" class="text-center">
					<thead class="text-capitalize">
						<tr>
							<th>Status</th>
							<th>Username</th>
							<th>E-mail</th>
							<th>Função</th>
							<th>Cadastrado em</th>
							<th>Autorizar</th>
						</tr>
					</thead>
					<tbody>
						<?PHP foreach($locks as $lock): ?>
							<tr>
								<td><?PHP echo $lock['User']['status'];?></td>
								<td><?PHP echo $lock['User']['username']; ?></td>
								<td><?PHP echo $lock['User']['email']; ?></td>
								<td><?PHP echo $lock['Role']['name']; ?></td>
								<td><?PHP echo $lock['User']['created']; ?></td>
								<td><?PHP echo $this->Html->link('Ver Pedido', array(
											'controller' => 'Users',
											'action' => 'admin_edit',
											$lock['User']['uuid'],
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

<div class="col-12 mt-5">
	<div class="card">
		<div class="card-body">
			<h4 class="header-title">Usuários Ativos</h4>
			<div class="data-tables datatable-dark">
				<table id="dataTable3" class="text-center">
					<thead class="text-capitalize">
						<tr>
							<th>Status</th>
							<th>Username</th>
							<th>E-mail</th>
							<th>Função</th>
							<th>Cadastrado em</th>
							<th>Autorizar</th>
						</tr>
					</thead>
					<tbody>
						<?PHP foreach($actives as $active): ?>
							<tr>
								<td><?PHP echo $active['User']['status'];?></td>
								<td><?PHP echo $active['User']['username']; ?></td>
								<td><?PHP echo $active['User']['email']; ?></td>
								<td><?PHP echo $active['User']['role']; ?></td>
								<td><?PHP echo $active['User']['created']; ?></td>
								<td><?PHP echo $this->Html->link('Ver Pedido', array(
											'controller' => 'Users',
											'action' => 'admin_edit',
											$active['User']['uuid'],
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

<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
