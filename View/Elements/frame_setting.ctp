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

<div class="form-group">
	<?php echo $this->NetCommonsForm->label(__d('photo_albums', 'Display type')); ?>
	<?php
		echo $this->NetCommonsForm->input(
			'PhotoAlbumFrameSetting.display_type',
			array(
				'type' => 'radio',
				'options' => array(
					PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS => __d('photo_albums', 'List of album'),
					PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS => __d('photo_albums', 'List of photo'),
					PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE => __d('photo_albums', 'Slide show')
				),
				'legend' => false,
				'div' => true,
				'class' => false,
				'label' => false,
				'before' => '<div class="radio-inline"><label class="radio-inline">',
				'after' => '</div></label>',
				'separator' => '</label></div><div class="radio-inline"><label class="radio-inline">',
				'ng-change' => 'FrameSettingController.changeDisplayType()',
				'ng-model' => 'FrameSettingController.displayType',
			)
		);
	?>
</div>

<!-- TODO ここで良い？下だと表示タイプの選択と距離が出る -->
<div class="form-group">
	<?php echo $this->NetCommonsForm->label(__d('photo_albums', 'Select display albums')); ?>

	<?php
		if (empty($albums)) {
			echo '<div>' . __d('photo_albums', 'Album is not found') . '</div>';
		} else {
			echo $this->element('PhotoAlbums.album_setting_list');
		}
	?>
</div>

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.albums_order',
		array(
			'type' => 'select',
			'options' => array(
				'PhotoAlbum.modified DESC' => __d('net_commons', 'Newest'),
				'PhotoAlbum.created ASC' => __d('net_commons', 'Oldest'),
				'PhotoAlbum.name ASC' => __d('net_commons', 'Title')
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
					'PhotoAlbum.modified DESC' => __d('net_commons', 'Newest'),
					'PhotoAlbum.created ASC' => __d('net_commons', 'Oldest'),
					'PhotoAlbum.name ASC' => __d('net_commons', 'Title')
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

