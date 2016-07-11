<?php
/**
 * PhotoAlbum album list template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php foreach ($albums as $album) : ?>
	<article class="panel panel-default photo-albums-album-list-panel">
		<div class="panel-body">
			<?php echo $this->PhotoAlbums->albumListAlert($album); ?>

			<div class="row">
				<div class="col-sm-3">
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
					<h1 class="photo-albums-album-list-caption">
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
						">
							<?php echo h($album['PhotoAlbum']['name']); ?>
						</a>
					</h1>

					<div class="photo-albums-album-note small">
						<span>
							<?php echo __d('photo_albums', '%s photos', $album['PhotoAlbum']['photo_count']); ?>
						</span>
						<span>
							<?php echo __d('photo_albums', 'Updated date:%s', $this->Date->dateFormat($album['PhotoAlbum']['modified'])); ?>
						</span>
						<span>
							<?php echo $this->DisplayUser->handleLink($album, array('avatar' => true)); ?>
						</span>
					</div>

					<p class="photo-albums-description">
						<?php echo h($album['PhotoAlbum']['description']); ?>
					</p>
				</div>
			</div>
		</div>
	</article>
<?php endforeach; ?>

<?php echo $this->element('NetCommons.paginator');
