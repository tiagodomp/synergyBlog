<div class="profiles index">
	<h2><?php echo __('Profiles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('uuid'); ?></th>
			<th><?php echo $this->Paginator->sort('user_uuid'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('contacts'); ?></th>
			<th><?php echo $this->Paginator->sort('img'); ?></th>
			<th><?php echo $this->Paginator->sort('gamification'); ?></th>
			<th><?php echo $this->Paginator->sort('configuration'); ?></th>
			<th><?php echo $this->Paginator->sort('info'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($profiles as $profile): ?>
	<tr>
		<td><?php echo h($profile['Profile']['uuid']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['user_uuid']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['contacts']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['img']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['gamification']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['configuration']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['info']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['created']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['modified']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $profile['Profile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $profile['Profile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $profile['Profile']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $profile['Profile']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?></li>
	</ul>
</div>
