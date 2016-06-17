<?php
/**
 * Jacket select template for edit album
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div ng-controller="PhotoAlbumsPreviewController">
	<?php
		$this->Form->unlockField('PhotoAlbum.selectedJacketPhotoId');
		echo $this->NetCommonsForm->hidden(
			'PhotoAlbum.selectedJacketPhotoId',
			array('ng-value' => 'selectedJacket.photo_id')
		);
	?>

	<div class="row">
		<div class="col-sm-3 photo-albums-selected-jacket">
			<div class="thumbnail photo-albums-thumbnail" ng-show="selectedJacket.url == undefind && selectedJacket.index == undefind">
				<img src="<?php echo $this->PhotoAlbumsImage->jacketUrl($this->request->data, 'medium'); ?>">
			</div>
			<div class="thumbnail photo-albums-thumbnail" ng-show="selectedJacket.url != undefind">
				<img src="{{selectedJacket.url}}">
			</div>
			<div class="text-center small">
				<?php echo __d('photo_albums', 'Jacket preview'); ?>
			</div>
		</div>

		<div class="col-sm-9">
			<div class="photo-albums-preview-list">
				<?php if (!$photos) : ?>
					<div class="photo-albums-thumbnail-not-selected">
						<?php echo __d('photo_albums', 'There is not a photo of the jacket. Add to photo from photo list.'); ?>
					</div>
				<?php endif; ?>

				<?php if ($photos) : ?>
					<div class="clearfix">
						<div class="pull-left">
							<?php echo __d('photo_albums', 'Click the photo, then the jacket changes.'); ?>
						</div>
						<div class="pull-right">
							<?php echo __d('photo_albums', '%s photos', count($photos)); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php foreach ($photos as $index => $photo) : ?>
					<div class="photo-albums-preview-photo">
						<a class="thumbnail" href="#" ng-click="selectJacketUrl(
							<?php echo sprintf('\'%s\', %s', $this->PhotoAlbumsImage->photoUrl($photo, 'small'), $photo['PhotoAlbumPhoto']['id']); ?>
						)">
							<?php echo $this->PhotoAlbumsImage->photoImage($photo, 'small'); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
