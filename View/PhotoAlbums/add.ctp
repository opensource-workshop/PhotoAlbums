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

<?php echo $this->NetCommonsForm->create('PhotoAlbum', array('type' => 'file')); ?>
	<?php echo $this->element('PhotoAlbums.album_form'); ?>

	<hr />
	<?php echo $this->Workflow->inputComment('PhotoAlbum.status'); ?>
	<?php echo $this->Workflow->buttons('PhotoAlbum.status'); ?>
<?php echo $this->NetCommonsForm->end(); ?>

<?php if ($this->request->params['action'] === 'edit') : ?>
	<div class="panel-footer text-right">
		<?php echo $this->Button->delete('',
			sprintf(__d('net_commons', 'Deleting the %s. Are you sure to proceed?'), __d('faqs', 'Question'))
		); ?>
	</div>
<?php endif; ?>
