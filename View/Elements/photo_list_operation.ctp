<?php
/**
 * PhotoAlbum photo list operation template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="clearfix photo-albums-photo-list-operation">
	<?php if (Current::permission('photo_albums_photo_creatable')): ?>
		<div class="pull-right" ng-controller="PhotoAlbumsPhotoController as PhotoController">
			<?php
				echo $this->Button->addLink(
					__d('photo_albums', 'Add photo'),
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
		</div>
	<?php endif; ?>

	<?php if (!empty($photos)): ?>
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

			<span class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php
						switch ($this->Paginator->sortKey('PhotoAlbumPhoto') . ' ' . $this->Paginator->sortDir('PhotoAlbumPhoto')) {
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
	<?php endif; ?>
</div>
