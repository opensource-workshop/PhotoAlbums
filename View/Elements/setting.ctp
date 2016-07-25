<?php
/**
 * PhotoAlbum block role permissions template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->element('Blocks.form_hidden'); ?>

<?php
	echo $this->element(
		'Blocks.block_creatable_setting',
		array(
			'settingPermissions' => array(
				'content_creatable' => __d('blocks', 'Content creatable roles'),
				'photo_albums_photo_creatable' => __d('photo_albums', 'Photo creatable roles'),
			),
		)
	);

	echo $this->element(
		'Blocks.block_approval_setting',
		array(
			'model' => 'PhotoAlbumSetting',
			'useWorkflow' => 'use_workflow',
			'options' => array(
				Block::NEED_APPROVAL => __d('blocks', 'Need approval'),
				Block::NOT_NEED_APPROVAL => __d('blocks', 'Not need approval'),
			),
		)
	);
?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.use_like'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.use_unlike'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.use_comment'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.use_comment_approval');
