<div class="posts index">
	<h2><?php echo __('Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('user_id', 'Author'); ?></th>
			<th><?php echo $this->Paginator->sort('title', 'Titulo'); ?></th>
			<th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
			<th><?php echo $this->Paginator->sort('body', 'Post'); ?></th>
			<th><?php echo $this->Paginator->sort('comment_id', 'Comentários'); ?></th>
			<th><?php echo $this->Paginator->sort('tag_id', 'Tags'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Criado em'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Última Modificação'); ?></th>
			<th class="actions"><?php echo __('Ações'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($posts as $post): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
		</td>
		<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['description']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['body']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['comment_id']); ?>&nbsp;</td>
		<td><?php foreach($post['Tag'] as $tags){
					$tags = array_values($tags);
					echo h((!empty($tags))?$tags[0].', ':'');
				}
			?></td>
		<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Comment'), array('controller' => 'comments','action' => 'add', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
