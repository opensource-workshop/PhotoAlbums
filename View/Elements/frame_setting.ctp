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
	<?php echo $this->NetCommonsForm->label(__d('PhotoAlbums', 'Display type')); ?>
	<?php
		echo $this->NetCommonsForm->input(
			'PhotoAlbumFrameSetting.display_type',
			array(
				'type' => 'radio',
				'options' => array(
					PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS => __d('PhotoAlbums', 'List of album'),
					PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS => __d('PhotoAlbums', 'List of photo'),
					PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE => __d('PhotoAlbums', 'Slide show')
				),
				'legend' => false,
				'div' => true,
				'class' => false,
				'label' => false,
				'before' => '<div class="radio-inline"><label class="radio-inline">',
				'after' => '</div></label>',
				'separator' => '</label></div><div class="radio-inline"><label class="radio-inline">',
			)
		);
	?>
</div>

<div class="form-group">
	<?php echo $this->NetCommonsForm->label(__d('PhotoAlbums', 'Select display albums')); ?>

	<?php
		if (empty($albums)) {
			echo '<div>' . __d('PhotoAlbums', 'Album is not found') . '</div>';
		} else {
			echo $thuis->element('PhotoAlbums.alubum_list');
		}
	?>
</div>

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.albums_order',
		array(
			'type' => 'select',
			'options' => array(
				'PhotoAlbum.modified DESC' => __d('NetCommons', 'Newest'),
				'PhotoAlbum.created ASC' => __d('NetCommons', 'Oldest'),
				'PhotoAlbum.name ASC' => __d('NetCommons', 'Title')
			),
			'label' => __d('PhotoAlbums', 'Albums display order')
		)
	);

	echo $this->DisplayNumber->select(
		'PhotoAlbumFrameSetting.albums_per_page',
		array(
			'label' => __d('PhotoAlbums', 'Show albums per page'),
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
							'PhotoAlbum.modified DESC' => __d('NetCommons', 'Newest'),
							'PhotoAlbum.created ASC' => __d('NetCommons', 'Oldest'),
							'PhotoAlbum.name ASC' => __d('NetCommons', 'Title')
					),
					'label' => __d('PhotoAlbums', 'Photos display order')
			)
		);

		echo $this->DisplayNumber->select(
			'PhotoAlbumFrameSetting.photos_per_page',
			array(
				'label' => __d('PhotoAlbums', 'Show photos per page'),
			)
		);
	?>
</div>

