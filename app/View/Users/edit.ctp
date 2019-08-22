<div class="users form">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Editar Usuário'); ?></legend>
		<?php
		echo $this->Form->hidden('uuid', array('value' => $this->data['User']['uuid']));
		echo $this->Form->input('username', array('readonly' => 'readonly', 'label' => 'Não altere o nome do usuário'));
		echo $this->Form->input('email');
		echo $this->Form->input('password_update', array('label' => 'Nova senha (Deixe em branco se quiser alterar)', 'maxLength' => 15, 'type' => 'password', 'required' => 0));
		echo $this->Form->input('password_confirm_update', array('label' => 'Confirme a nova senha *', 'maxLength' => 15, 'title' => 'Confirme nova senha', 'type' => 'password', 'required' => 0));


		echo $this->Form->input('role', array(
			'options' => array('admin' => 'Administrador', )
		));
		echo $this->Form->submit('Editar Usuário', array('class' => 'form-submit', 'title' => 'Salvar'));
		?>
	</fieldset>
	<?php echo $this->Form->end(); ?>
</div>
<?php
echo $this->Html->link("Home", array('action' => 'index'));
?>
<br />
<?php
echo $this->Html->link("Sair", array('action' => 'logout'));
?>