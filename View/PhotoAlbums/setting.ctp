<?php
/**
 * PhotoAlbumSettings setting template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>
<?php echo $this->NetCommonsHtml->css('/photo_albums/css/photo_albums.css'); ?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main('block_index'); ?>

	<div class="tab-content">
		<?php echo $this->BlockIndex->description(__d('photo_albums', 'Change displayed alubum on %s', __d('net_commons', 'Frame settings'))); ?>
		<?php echo $this->element('PhotoAlbums.album_list_operation'); ?>
		<?php echo $this->element('PhotoAlbums.album_setting_list'); ?>
		<?php echo $this->element('NetCommons.paginator'); ?>
	</div>
</article>
