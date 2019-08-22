<div class="profiles view">
<h2><?php echo __('Profile'); ?></h2>
	<dl>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Uuid'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['user_uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contacts'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['contacts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gamification'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['gamification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Configuration'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['configuration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Profile'), array('action' => 'delete', $profile['Profile']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $profile['Profile']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?> </li>
	</ul>
</div>
