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

<?php echo $this->NetCommonsHtml->script('/photo_albums/js/photo_albums.js'); ?>

<?php echo $this->NetCommonsForm->create('PhotoAlbum', array('type' => 'file')); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.block_id'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.key'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.language_id'); ?>
	<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.status'); ?>

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

	<?php
		echo $this->NetCommonsForm->input(
			'PhotoAlbum.description',
			array(
				'type' => 'textarea',
				'label' => __d('photo_albums', 'Album description'),
				'help' => __d('photo_albums', 'You can see this value on album list or top of photo list.'),
			)
		);
	?>

	<div ng-controller="PhotoAlbumsPreviewController">
		<?php
			App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');
			$this->Form->unlockField('PhotoAlbumPhoto..' . PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME);
			$this->Form->unlockField('PhotoAlbumPhoto.' . PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME);
			$this->Form->unlockField('PhotoAlbum.selectedJacketIndex');
			echo $this->NetCommonsForm->uploadFile(
				'PhotoAlbumPhoto..' . PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME,
				array(
					'label' => __d('photo_albums', 'Upload photos'),
					'help' => __d('photo_albums', 'Select photo file. You can select zip file.'),
					'required' => true,
					'multiple',
					'nc-photo-albums-preview' => 'preview()',
				)
			);
			echo $this->NetCommonsForm->hidden(
				'PhotoAlbum.selectedJacketIndex',
				array('ng-value' => 'selectedJacket.index')
			);
		?>

		<div class="row">
			<div class="col-sm-3">
				<div class="thumbnail photo-albums-thumbnail" ng-show="selectedJacket.index >= 0">
					<img ng-src="{{selectedJacket.fileReaderResult}}">
				</div>
				<div class="thumbnail photo-albums-thumbnail-not-selected" ng-show="selectedJacket.index == undefind">
				</div>
				<span class="small">
					<?php echo __d('photo_albums', 'Jacket preview'); ?>
				</span>
			</div>


			<div class="col-sm-9 photo-albums-preview-list">
				<div class="photo-albums-thumbnail-not-selected" ng-show="selectedJacket.index == undfind">
					<?php echo __d('photo_albums', 'Select photo'); ?>
				</div>
				<div class="photo-albums-preview-photo" ng-repeat="(index, fileReaderResult) in fileReaderResults track by $index">
					<a class="thumbnail" href="#" ng-click="selectJacket(index)">
						<img ng-src="{{fileReaderResult}}">
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr />
	<?php echo $this->Workflow->inputComment('PhotoAlbum.status'); ?>
	<?php echo $this->Workflow->buttons('PhotoAlbum.status', $this->request->referer()); ?>
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

<?php echo $this->Workflow->comments();
