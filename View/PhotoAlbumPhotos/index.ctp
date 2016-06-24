<?php
/**
 * photoAlbum content list view template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->NetCommonsHtml->css('/photo_albums/css/photo_albums.css'); ?>
<?php echo $this->NetCommonsHtml->script('/photo_albums/js/photo_albums.js'); ?>

<article class="panel panel-default photo-albums-album-information">
	<div class="panel-body">
		<div class="clearfix">
			<div class="pull-right photo-albums-album-edit-link">
				<?php
					if ($this->Workflow->canEdit('PhotoAlbum', $album)) {
						echo $this->LinkButton->edit(
							__d('photo_albums', 'Edit album'),
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_albums',
								'action' => 'edit',
								'key' => $album['PhotoAlbum']['key']
							),
							array(
								'tooltip' => __d('photo_albums', 'Edit album'),
							)
						);
					}
				?>
			</div>

			<div class="pull-left">
				<div class="photo-albums-album-list-status">
					<?php echo $this->Workflow->label($album['PhotoAlbum']['status']) ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3 hidden-xs">
				<a href="
					<?php
						echo $this->NetCommonsHtml->url(
							array(
								'controller' => 'photo_album_photos',
								'action' => 'index',
								$album['PhotoAlbum']['key']
							)
						);
					?>
				" class="thumbnail photo-albums-thumbnail">
					<?php //echo $this->PhotoAlbums->jacketByBackground($album); ?>
					<?php echo $this->PhotoAlbums->jacket($album); //imgタグ ?>
				</a>
			</div>

			<div class="col-sm-9">
				<?php echo $this->element('PhotoAlbums.album_caption'); ?>
			</div>
		</div>
	</div>
</article>

<?php echo $this->element('PhotoAlbums.photo_list_operation'); ?>

<div class="row photo-albums-photo-list" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<?php foreach ($photos as $index => $photo) : ?>
		<div class="col-lg-3 col-md-4 col-sm-6">
			<div class="thumbnail">
				<div class="photo-albums-photo-thumbnail">
					<a href="#" ng-click="PhotoController.slide('
						<?php
							echo $this->NetCommonsHtml->url(
								array(
									'plugin' => 'photo_albums',
									'controller' => 'photo_album_photos',
									'action' => 'slide',
									$album['PhotoAlbum']['key'],
									(($this->Paginator->current() - 1) * $this->Paginator->param('limit')) + $index,
									'sort' => $this->Paginator->sortKey('PhotoAlbumPhoto'),
									'direction' => $this->Paginator->sortDir('PhotoAlbumPhoto'),
								)
							)
						?>
					')">

						<div class="photo-albums-photo" style="background-image:url(<?php echo $this->PhotoAlbumsImage->photoUrl($photo, 'medium'); ?>);"></div>
					</a>

					<div class="photo-albums-photo-list-status">
						<?php echo $this->Workflow->label($photo['PhotoAlbumPhoto']['status']); ?>
					</div>

					<?php echo $this->PhotoAlbums->photoActionBar($photo); ?>
				</div>

				<div class="photo-albums-photo-description small">
					<?php echo h($photo['PhotoAlbumPhoto']['description']); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php echo $this->PhotoAlbums->approveAllButton($photos); ?>

<?php echo $this->element('NetCommons.paginator');
