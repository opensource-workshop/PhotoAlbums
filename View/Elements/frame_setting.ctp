<?php
/**
 * PhotoAlbum frame setting template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->Html->css('/photo_albums/css/photo_albums.css'); ?>

<?php echo $this->NetCommonsForm->hidden('id'); ?>
<?php echo $this->NetCommonsForm->hidden('frame_key'); ?>

<div class="form-group photo-albums-frame-setting-display-type">
	<?php
		echo $this->NetCommonsForm->input(
			'PhotoAlbumFrameSetting.display_type',
			array(
				'type' => 'radio',
				'options' => array(
					PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS => __d('photo_albums', 'List of album'),
					PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS => __d('photo_albums', 'List of photo'),
				),
				'div' => false,
				'class' => false,
				'label' => __d('photo_albums', 'Display type'),
				'error' => false,
				'ng-change' => 'FrameSettingController.checkDisplayTypeSlide = false',
				'ng-model' => 'FrameSettingController.displayType',
			)
		);
	?>
	<div class="form-checkbox-outer">
			<div class="checkbox">
			<label class="control-label">
				<?php
					echo $this->NetCommonsForm->input(
						'PhotoAlbumFrameSetting.display_type',
						array(
							'type' => 'checkbox',
							'value' => PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE,
							'div' => false,
							'class' => false,
							'hiddenField' => false,
							'ng-model' => 'FrameSettingController.checkDisplayTypeSlide',
							'ng-change' => 'FrameSettingController.checkDisplayTypeSlide && (FrameSettingController.displayType=' . PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS . ')',
						)
					) . __d('photo_albums', 'Slide show');
				?>
			</label>
		</div>
	</div>
</div>

<!-- TODO ここで良い？下だと表示タイプの選択と距離が出る -->
<div class="form-group">
	<?php echo $this->NetCommonsForm->label(__d('photo_albums', 'Select display albums')); ?>

	<?php
		if (empty($albums)) {
			echo '<div>' . __d('photo_albums', 'Album is not found') . '</div>';
		} else {
			echo $this->element('PhotoAlbums.album_frame_setting_list');
		}
	?>
</div>

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.albums_order',
		array(
			'type' => 'select',
			'options' => array(
				'PhotoAlbum.modified desc' => __d('net_commons', 'Newest'),
				'PhotoAlbum.created asc' => __d('net_commons', 'Oldest'),
				'PhotoAlbum.name asc' => __d('net_commons', 'Title')
			),
			'label' => __d('photo_albums', 'Albums display order')
		)
	);

	echo $this->DisplayNumber->select(
		'PhotoAlbumFrameSetting.albums_per_page',
		array(
			'label' => __d('photo_albums', 'Show albums per page'),
		)
	);
?>

<div class='photo-albums-frame-setting-page-group'>
	<?php
		echo $this->NetCommonsForm->input(
			'PhotoAlbumFrameSetting.photos_order',
			array(
				'type' => 'select',
				'options' => array(
					'PhotoAlbumPhoto.modified desc' => __d('net_commons', 'Newest'),
					'PhotoAlbumPhoto.created asc' => __d('net_commons', 'Oldest')
				),
				'label' => __d('photo_albums', 'Photos display order')
			)
		);

		echo $this->DisplayNumber->select(
			'PhotoAlbumFrameSetting.photos_per_page',
			array(
				'label' => __d('photo_albums', 'Show photos per page'),
			)
		);
	?>
</div>

