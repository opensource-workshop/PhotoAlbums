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
							'PhotoAlbum.modified DESC' => __d('net_commons', 'Newest'),
							'PhotoAlbum.created ASC' => __d('net_commons', 'Oldest'),
							'PhotoAlbum.name ASC' => __d('net_commons', 'Title')
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

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.display_type',
		array(
				'type' => 'radio',
				'options' => array(
						'PhotoAlbum.modified DESC' => __d('net_commons', 'Newest'),
						'PhotoAlbum.created ASC' => __d('net_commons', 'Oldest'),
						'PhotoAlbum.name ASC' => __d('net_commons', 'Title')
				),
				'label' => __d('PhotoAlbums', 'Photos display order')
		)
	);
?>

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
