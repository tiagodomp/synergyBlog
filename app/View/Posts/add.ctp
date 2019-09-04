<?PHP echo $this->Html->script('jquery.amsify.suggestags'); ?>

<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('body', array('type' => 'textarea'));
		echo $this->Form->input('tags', array('mutiples'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script>
$('input[name="data[Post][tags]"]').amsifySuggestags({
					type : 'amsify',
					suggestions: <?PHP echo json_encode($tags);  ?>,
				});
</script>
