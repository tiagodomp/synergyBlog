<div class="profiles form">
<?php echo $this->Form->create('Profile'); ?>
	<fieldset>
		<legend><?php echo __('Add Profile'); ?></legend>
	<?php
		echo $this->Form->input('uuid');
		echo $this->Form->input('user_uuid');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('contacts');
		echo $this->Form->input('img');
		echo $this->Form->input('gamification');
		echo $this->Form->input('configuration');
		echo $this->Form->input('info');
		echo $this->Form->input('deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
	</ul>
</div>
