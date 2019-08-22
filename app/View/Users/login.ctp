<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Por Favor insira o seu username e senha'); ?></legend>
		<?php
			echo $this->Form->input('username');
			echo $this->Form->input('password', array('label' => 'Senha'));
		?>
    </fieldset>
<?php echo $this->Form->end(__('Entrar')); ?>
</div>
<?php echo $this->Html->link("Registrar-se", array('action' => 'add')); ?>


