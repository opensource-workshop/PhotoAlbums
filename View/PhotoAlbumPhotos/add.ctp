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

<?php $this->assign('title_for_modal', __d('PhotoAlbums', 'Add photo')); ?>

<?php echo $this->NetCommonsForm->create('PhotoAlbumPhoto', array('type' => 'file')); ?>
	<?php echo $this->NetCommonsForm->input('key', array('type' => 'hidden')); ?>
	<?php echo $this->NetCommonsForm->hidden('language_id'); ?>

	<?php
		echo $this->NetCommonsForm->uploadFile(
			'photo',
			array(
				'label' => __d('PhotoAlbums', 'Photo file'),
				'remove' => false
			)
		)
	?>

	<?php
		echo $this->NetCommonsForm->input(
			'description',
			array(
				'type' => 'textarea',
				'label' => __d('PhotoAlbums', 'Photo description'),
			)
		);
	?>

	<hr />
	<?php echo $this->Workflow->inputComment('PhotoAlbum.status'); ?>
	<?php echo $this->Workflow->buttons('PhotoAlbumPhoto.status'); ?>

<?php echo $this->NetCommonsForm->end() ?>