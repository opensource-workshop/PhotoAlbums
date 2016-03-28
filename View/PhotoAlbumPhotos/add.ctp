<?php
/**
 * Album add template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php $this->assign('title_for_modal', __d('photo_albums', 'Add photo')); ?>

<?php echo $this->NetCommonsForm->create('PhotoAlbumPhoto', array('type' => 'file')); ?>
	<?php if (!empty($this->request->data['PhotoAlbumPhoto']['key'])): ?>
		<div class="thumbnail">
			<?php
				echo $this->Html->image(
					array(
						'controller' => 'photo_album_photos',
						'action' => 'photo',
						Current::read('Block.id'),
						$this->request->data['PhotoAlbumPhoto']['album_key'],
						$this->request->data['PhotoAlbumPhoto']['id']
					),
					array(
						'alt' => __d('photo_albums', 'photo')
					)
				);
			?>
		</div>
	<?php endif; ?>

	<?php echo $this->NetCommonsForm->hidden('album_key'); ?>
	<?php echo $this->NetCommonsForm->hidden('key'); ?>
	<?php echo $this->NetCommonsForm->hidden('language_id'); ?>

	<?php
		echo $this->NetCommonsForm->uploadFile(
			PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME,
			array(
				'label' => __d('photo_albums', 'Photo file'),
				'remove' => false
			)
		)
	?>

	<?php
		echo $this->NetCommonsForm->input(
			'description',
			array(
				'type' => 'textarea',
				'label' => __d('photo_albums', 'Photo description'),
			)
		);
	?>

	<hr />
	<?php echo $this->Workflow->inputComment('PhotoAlbum.status'); ?>
	<?php echo $this->Workflow->buttons('PhotoAlbumPhoto.status'); ?>

<?php echo $this->NetCommonsForm->end() ?>