<script data-require="jquery@2.2.4" data-semver="2.2.4" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <link data-require="bootstrap@3.3.7" data-semver="3.3.7" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 <script data-require="bootstrap@3.3.7" data-semver="3.3.7" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css" />

<script>
$(document).ready(function(){
 var def = $('#PostTags').val();
 $.each(def, function(val){
	 val = 1;
    $('#PostTagId option[value='+val+']').attr('selected','selected');
 });


});
</script>
<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
	<?php
		$value = implode(', ', array_keys($tags));
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('body');
		echo $this->Form->input('tag_id', array('div' => false, 'label'=> 'Tags', 'class'=>'selectpicker', 'multiple', 'data-live-search' => 'true' ));
		echo $this->Form->input('tags', array('type' => 'hidden', 'value' => $value));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Post.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>


<script>
$(document).ready(function(){
 $('#PostTagId').change(function(){
  $('#PostTags').val($('#PostTagId').val());
 });
});
</script>
