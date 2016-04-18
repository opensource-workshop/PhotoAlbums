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


<h2><?php echo $album['PhotoAlbum']['name']; ?></h2>
<p>
<?php echo $album['PhotoAlbum']['description']; ?>
</p>

<div class="text-right" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<?php if (Current::permission('photo_albums_photo_creatable')): ?>
		<?php
			echo $this->Button->addLink(
				'',
				'#',
				array(
					'ng-click' => 'PhotoController.openAdd(\'' .
						$this->NetCommonsHtml->url(
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'add',
								$album['PhotoAlbum']['key'],
							)
						) .
					'\')'
				)
			);
		?>
	<?php endif; ?>
</div>

<div class="photo-albums-photo-list-operation">
	<div class="pull-left">
		<span class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<?php
					switch (Hash::get($this->request->params, ['named', 'status'])) {
						case WorkflowComponent::STATUS_APPROVED:
							echo __d('photo_albums', 'Pending approved');
							break;
						case WorkflowComponent::STATUS_DISAPPROVED:
							echo __d('photo_albums', 'Disapproved');
							break;
						case WorkflowComponent::STATUS_IN_DRAFT:
							echo __d('photo_albums', 'In draft');
							break;
						default:
							echo __d('net_commons', 'Display all');
					}
				?>
				<span class="caret">
				</span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li>
					<?php
						echo $this->Paginator->link(
							__d('net_commons', 'Display all'),
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'index',
								$this->request->params['pass'][1],
							)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Paginator->link(
							__d('photo_albums', 'Pending approved'),
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'index',
								$this->request->params['pass'][1],
								'status' => WorkflowComponent::STATUS_APPROVED
							)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Paginator->link(
							__d('photo_albums', 'Disapproved'),
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'index',
								$this->request->params['pass'][1],
								'status' => WorkflowComponent::STATUS_DISAPPROVED
							)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Paginator->link(
							__d('photo_albums', 'In draft'),
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'index',
								$this->request->params['pass'][1],
								'status' => WorkflowComponent::STATUS_IN_DRAFT
							)
						);
					?>
				</li>
			</ul>
		</span>
	</div>

	<div class="text-right">
		<span class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<?php
					switch ($this->Paginator->sortKey() . ' ' . $this->Paginator->sortDir()) {
						case 'PhotoAlbumPhoto.modified desc':
							echo __d('net_commons', 'Newest');
							break;
						default:
							echo __d('net_commons', 'Oldest');
					}
				?>
				<span class="caret">
				</span>
			</button>
			<ul class="dropdown-menu">
				<li>
					<?php
						echo $this->Paginator->sort(
							'PhotoAlbumPhoto.modified',
							__d('net_commons', 'Newest'),
							array(
								'direction' => 'desc',
								'lock' => true
							)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Paginator->sort(
							'PhotoAlbumPhoto.created',
							__d('net_commons', 'Oldest'),
							array(
								'direction' => 'asc',
								'lock' => true
							)
						);
					?>
				</li>
			</ul>
		</span>
		<?php echo $this->DisplayNumber->dropDownToggle(); ?>
	</div>
</div>

<hr>

<div class="row" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<?php foreach ($photos as $index => $photo) : ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<a href="/photo_albums/photo_album_photos/slide?frame_id=37">
					<?php
						echo $this->Html->image(
							array(
								'controller' => 'photo_album_photos',
								'action' => 'photo',
								Current::read('Block.id'),
								$photo['PhotoAlbumPhoto']['album_key'],
								$photo['PhotoAlbumPhoto']['id']
							),
							array(
								'alt' => __d('photo_albums', 'Photo')
							)
						);
					?>
				</a>
				<div class="caption" style="overflow: hidden;height: 4em;">
					<?php echo nl2br($photo['PhotoAlbumPhoto']['description']) ?>
				</div>

				<?php echo $this->PhotoAlbums->photoActionBar($photo); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php echo $this->PhotoAlbums->approveAllButton($photos); ?>

<hr>
<?php echo $this->element('NetCommons.paginator'); ?>
<hr>

<footer>
	<div class="row">
		<div class="col-xs-12 text-center">
			<?php echo $this->BackTo->pageLinkButton(__d("photo_albums", "Back to album list"), array('icon' => '')); ?>
		</div>
	</div>
</footer>