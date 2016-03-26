<div class="photoAlbumPhotos view">
<h2><?php echo __('Photo Album Photo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['block_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Album Key'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['album_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language Id'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['language_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Latest'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['is_latest']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photoAlbumPhoto['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $photoAlbumPhoto['TrackableCreator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Updater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photoAlbumPhoto['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $photoAlbumPhoto['TrackableUpdater']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($photoAlbumPhoto['PhotoAlbumPhoto']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo Album Photo'), array('action' => 'edit', $photoAlbumPhoto['PhotoAlbumPhoto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo Album Photo'), array('action' => 'delete', $photoAlbumPhoto['PhotoAlbumPhoto']['id']), null, __('Are you sure you want to delete # %s?', $photoAlbumPhoto['PhotoAlbumPhoto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photo Album Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo Album Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
