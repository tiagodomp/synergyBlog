<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Criar Usuário'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm', array('label' => 'Confirme sua senha', 'maxLength' => 64, 'title' => 'Confirmar Senha', 'type' => 'password'));
		echo $this->Form->input('role', array(
			'options' => array( 'admin' => 'Administrador', 'workerMaster' => 'Funcionário Mestre', 'worker' => 'Funcionário')
		));

		echo $this->Form->submit('Salvar', array('class' => 'form-submit', 'title' => 'Salvar usuário'));
	?>

	</fieldset>
</div>
<?php
	if($this->Session->check('Auth.User')){
		echo $this->Html->link("Home", array('action' => 'index') );
		echo "<br>";
		echo $this->Html->link("Sair", array('action' => 'logout') );
	}else{
		echo $this->Html->link("Fazer Login", array('action' => 'login') );
	}
?>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Lista de Usuários'), array('action' => 'index')); ?></li>
	</ul>
</div>
