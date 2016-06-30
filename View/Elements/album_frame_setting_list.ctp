<?php
/**
 * PhotoAlbum album frame list template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="photo-albums-frame-setting-list">
	<table class="table photo-albums-setting-list">
		<thead>
			<tr>
				<th>
					<?php
						/*
						echo $this->Form->input(
							'PhotoAlbumDisplayAlbum..album_key',
							array(
								'type' => 'checkbox',
								'checked' => false,
								'label' => false,
								'div' => false,
								'class' => false,
								'hiddenField' => false,
								//'ng-model' => 'FrameSettingController.checkModel[' . $index . ']',
								'ng-disabled' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS,
								'ng-hide' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS
							)
						);
						*/
					?>
				</th>
				<?php echo $this->TableList->tableHeader('PhotoAlbum.name', __d('photo_albums', 'Album Name'), ['sort' => true]); ?>
				<?php echo $this->TableList->tableHeader('PhotoAlbum.status', __d('photo_albums', 'Status'), ['sort' => true]); ?>
				<?php echo $this->TableList->tableHeader('PhotoAlbum.latest_photo_count', __d('photo_albums', 'Photo'), ['sort' => true, 'type' => 'numeric']); ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($albums as $album) : ?>
				<tr<?php echo $this->PhotoAlbums->activeClass($album) ?>>
					<td>
						<?php
							echo $this->Form->input(
								'PhotoAlbumDisplayAlbum..album_key',
								array(
									'type' => 'checkbox',
									'value' => $album['PhotoAlbum']['key'],
									'checked' => in_array($album['PhotoAlbum']['key'], $displayAlbumKeys),
									'label' => false,
									'div' => false,
									'class' => false,
									'hiddenField' => false,
									//'ng-model' => 'FrameSettingController.checkAlbumKeys[' . $album['PhotoAlbum']['key'] . ']',
									'ng-disabled' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS,
									'ng-hide' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS
								)
							);

							$this->Form->unlockField('PhotoAlbumDisplayAlbum..album_key');
							$this->Form->unlockField('PhotoAlbumDisplayAlbum.album_key');
							echo $this->Form->input(
								'PhotoAlbumDisplayAlbum..album_key',
								array(
									'type' => 'radio',
									'options' => array($album['PhotoAlbum']['key'] => null),
									'label' => false,
									'div' => false,
									'class' => false,
									'hiddenField' => false,
									'ng-model' => 'FrameSettingController.checkAlbumKey',
									'ng-disabled' => 'FrameSettingController.displayType == ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS,
									'ng-hide' => 'FrameSettingController.displayType == ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS
								)
							);
						?>
					</td>
					<td>
						<div class="thumbnail photo-albums-setting-thumbnail">
							<?php echo $this->PhotoAlbums->jacket($album, 'small'); ?>
						</div>

						<div class="photo-albums-name">
							<?php echo h($album['PhotoAlbum']['name']) ?>
						</div>
					</td>
					<?php echo $this->TableList->tableData('PhotoAlbum.status', $this->Workflow->label($album['PhotoAlbum']['status']), ['escape' => false]); ?>
					<?php echo $this->TableList->tableData('PhotoAlbum.latest_photo_count', $album['PhotoAlbum']['latest_photo_count'], ['type' => 'numeric']); ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
