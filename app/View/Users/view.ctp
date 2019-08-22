<div class="users view">
<h2><?php echo __('usuários'); ?></h2>
	<dl>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($user['User']['uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('E-mail'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Senha'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Usuário'), array('action' => 'edit', $user['User']['uuid'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Apagar Usuário'), array('action' => 'delete', $user['User']['uuid']), array('confirm' => __('Você realmente deseja excluir @%s?', $user['User']['username']))); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuários'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Inserir Usuário'), array('action' => 'add')); ?> </li>
	</ul>
</div>
