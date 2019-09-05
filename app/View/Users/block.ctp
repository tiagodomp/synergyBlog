<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __( $this->request->data['User']['username'].' esta bloqueado'); ?></legend>
		Esse é o seu novo Token: <?PHP echo $this->request->data['User']['crypto']; ?>
	<?php

		echo $this->Form->input('username', array('type' => 'hidden'));
		echo $this->Form->input('token');
		echo $this->Form->input('password', array('type' => 'password'));
		echo $this->Form->input('password_confirm', array('type' => 'password'));
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>