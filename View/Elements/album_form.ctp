<?php
/**
 * Album form template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.key'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.language_id'); ?>

<div class = "row">
	<div class="col-md-4">
		<div class="thumbnail">
			<?php echo $this->PhotoAlbums->jacket($this->request->data); ?>
		</div>
		<?php
			echo $this->NetCommonsForm->uploadFile(
				PhotoAlbum::ATTACHMENT_FIELD_NAME,
				array(
					'label' => false
				)
			);
		?>
	</div>

	<div class="col-md-8">
		<?php
			echo $this->NetCommonsForm->input(
				'PhotoAlbum.name',
				array(
					'type' => 'text',
					'label' => __d('photo_albums', 'Album Name'),
					'required' => true,
				)
			);
		?>
	</div>
</div>

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbum.description',
		array(
			'type' => 'textarea',
			'label' => __d('photo_albums', 'Album description'),
		)
	);
?>
