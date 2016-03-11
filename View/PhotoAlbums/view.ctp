<div class="photoAlbums view">
<h2><?php echo __('Photo Album'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['block_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['language_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Latest'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['is_latest']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photoAlbum['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $photoAlbum['TrackableCreator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Updater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photoAlbum['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $photoAlbum['TrackableUpdater']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($photoAlbum['PhotoAlbum']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo Album'), array('action' => 'edit', $photoAlbum['PhotoAlbum']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo Album'), array('action' => 'delete', $photoAlbum['PhotoAlbum']['id']), null, __('Are you sure you want to delete # %s?', $photoAlbum['PhotoAlbum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photo Albums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo Album'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
