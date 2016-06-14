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
					<?php echo $this->element('PhotoAlbums.album_caption', ['album' => $album]); ?>
				</div>
			</div>
		</div>
	</article>
<?php endforeach; ?>

<?php echo $this->element('NetCommons.paginator');
