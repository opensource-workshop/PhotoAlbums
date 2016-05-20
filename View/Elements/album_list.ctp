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

<div class="row">
	<?php foreach ($albums as $album) : ?>
		<div class="col-md-6">
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
				<?php echo $this->PhotoAlbums->jacketByBackground($album); ?>
				<?php //echo $this->PhotoAlbums->jacket($album); //imgタグ ?>
			</a>

			<div class="carousel-caption photo-albums-caption">
				<?php echo $this->element('PhotoAlbums.album_caption', ['album' => $album]); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php echo $this->element('NetCommons.paginator'); ?>
