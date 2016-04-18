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
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.block_id'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.key'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.language_id'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.status'); ?>

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


	<hr />
	<?php echo $this->Workflow->inputComment('PhotoAlbum.status'); ?>
	<?php echo $this->Workflow->buttons('PhotoAlbum.status'); ?>
<?php echo $this->NetCommonsForm->end(); ?>

<?php if ($this->request->params['action'] === 'edit' && $this->Workflow->canDelete('PhotoAlbum', $this->request->data)) : ?>
	<div class="panel-footer text-right">
		<?php
			echo $this->NetCommonsForm->create(
				'PhotoAlbum',
				array(
					'type' => 'delete',
					'url' => array(
						'plugin' => 'photo_albums',
						'controller' => 'photo_albums',
						'action' => 'delete',
						Current::read('Block.id'),
						$this->request->data['PhotoAlbum']['key']
					)
				)
			);
		?>
			<?php
				echo $this->Button->delete('',
					sprintf(__d('net_commons', 'Deleting the %s. Are you sure to proceed?'), __d('photo_albums', 'Album'))
				);
			?>
		<?php echo $this->NetCommonsForm->end();?>
	</div>
<?php endif; ?>

<hr>
<?php echo $this->Workflow->comments(); ?>