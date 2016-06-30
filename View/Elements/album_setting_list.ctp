<?php
/**
 * PhotoAlbum album list template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<table class="table photo-albums-setting-list">
	<thead>
		<tr>
			<?php echo $this->TableList->tableHeader('PhotoAlbum.status', __d('photo_albums', 'Status'), ['sort' => true]); ?>
			<?php echo $this->TableList->tableHeader('PhotoAlbum.name', __d('photo_albums', 'Album Name'), ['sort' => true]); ?>
			<?php echo $this->TableList->tableHeader('PhotoAlbum.latest_photo_count', __d('photo_albums', 'Photo'), ['sort' => true, 'type' => 'numeric']); ?>
			<?php echo $this->TableList->tableHeader('TrackableUpdater.handlename', __d('net_commons', 'Modified user'), ['sort' => true, 'type' => 'handle']); ?>
			<?php echo $this->TableList->tableHeader('PhotoAlbum.modified', __d('net_commons', 'Modified datetime'), ['sort' => true, 'type' => 'datetime']); ?>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($albums as $album) : ?>
			<tr<?php echo $this->PhotoAlbums->activeClass($album) ?>>
				<?php echo $this->TableList->tableData('PhotoAlbum.latest_photo_count', $this->Workflow->label($album['PhotoAlbum']['status']), ['escape' => false]); ?>
				<td>
					<div class="thumbnail photo-albums-setting-thumbnail">
						<?php echo $this->PhotoAlbums->jacket($album, 'small'); ?>
					</div>

					<div class="photo-albums-name">
						<?php echo h($album['PhotoAlbum']['name']) ?>
						<?php
							$url = $this->Html->url(
								array(
									'base' => false,
									'plugin' => 'photo_albums',
									'controller' => 'photo_albums',
									'action' => 'edit',
									Current::read('Block.id'),
									$album['PhotoAlbum']['key'],
									'?' => ['frame_id' => Current::read('Frame.id')],
								)
							);
							echo $this->LinkButton->edit(
								'',
								$url,
								array('iconSize' => ' btn-xs')
							);
						?>
					</div>
				</td>
				<?php echo $this->TableList->tableData('PhotoAlbum.latest_photo_count', $album['PhotoAlbum']['latest_photo_count'], ['type' => 'numeric']); ?>
				<?php echo $this->TableList->tableData('TrackableUpdater', $album, ['type' => 'handle']); ?>
				<?php echo $this->TableList->tableData('PhotoAlbum.modified', $album['PhotoAlbum']['modified'], ['type' => 'datetime']); ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
