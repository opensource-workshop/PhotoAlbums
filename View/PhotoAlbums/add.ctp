<div class="photoAlbums form">
<?php echo $this->Form->create('PhotoAlbum'); ?>
	<fieldset>
		<legend><?php echo __('Add Photo Album'); ?></legend>
	<?php
		echo $this->Form->input('key');
		echo $this->Form->input('weight');
		echo $this->Form->input('block_id');
		echo $this->Form->input('language_id');
		echo $this->Form->input('status');
		echo $this->Form->input('is_active');
		echo $this->Form->input('is_latest');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('created_user');
		echo $this->Form->input('modified_user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Photo Albums'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
