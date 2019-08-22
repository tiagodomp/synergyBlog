<div class="users index">
	<h2><?php pr($users); exit;echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'uuid' => 'CheckAll')); ?></th>
				<th><?php echo $this->Paginator->sort('uuid'); ?></th>
				<th><?php echo $this->Paginator->sort('username'); ?></th>
				<th><?php echo $this->Paginator->sort('email', 'E-mail'); ?></th>
				<th><?php echo $this->Paginator->sort('password', 'Senha'); ?></th>
				<th><?php echo $this->Paginator->sort('role', 'Tipo de usuário'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('created', 'criado em'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $count = 0; ?>
			<?php foreach ($users as $user) : ?>
			<?php $count++; ?>
			<?php if($count % 2) : echo h('<tr>');
				else : echo h('<tr class="zebra">') ?>
			<?php endif; ?>
			<td><?php echo $this->Form->checkbox('User.uuid.' . $user['User']['uuid']); ?></td>
			<td><?php echo $this->Html->link($user['User']['username'], array('action' => 'edit', $user['User']['uuid']), array('escape' => false)); ?></td>
			<td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
			<td style="text-align: center;"><?php echo $user['User']['role']; ?></td>

			<?php if(echo $user['User']['status']) : echo h('<td style="background-color: green"></td>')
												else: echo h('<td style="background-color: red"></td>')?>
			 <?php endif; ?>
			<td>
				<?php echo $this->Html->link("Editar", array('action' => 'edit', $user['User']['uuid'])); ?> |
				<?php
					if ($user['User']['status'] != 0) {
						echo $this->Html->link("Apagar", array('action' => 'delete', $user['User']['uuid']));
					} else {
						echo $this->Html->link("Ativar", array('action' => 'activate', $user['User']['uuid']));
					}
					?>
			</td>
			</tr>
			<?php endforeach; ?>
			<?php unset($user); ?>
		</tbody>
	</table>
	<?php echo $this->Paginator->prev('<< ' . __('voltar', true), array(), null, array('class' => 'disabled')); ?>
	<?php echo $this->Paginator->numbers(array('class' => 'numbers')); ?>
	<?php echo $this->Paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>
	<?php echo $this->Html->link("Criar Novo usuário", array('action' => 'add'), array('escape' => false)); ?>
	<br />
	<?php echo $this->Html->link("Sair", array('action' => 'logout')); ?>