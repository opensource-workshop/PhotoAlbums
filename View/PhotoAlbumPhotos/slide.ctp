<?php
/**
 * PhotoAlbums photo slide template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php
echo $this->NetCommonsHtml->css('/photo_albums/css/style.css');
?>

<div class="modal-header">
	<button class="close" type="button"
			tooltip="<?php echo __d('net_commons', 'Close'); ?>"
			ng-click="cancel()">
		<span class="glyphicon glyphicon-remove small"></span>
	</button>

	<h4 class="modal-title"><?php echo $album['PhotoAlbum']['name']; ?></h4>
</div>

<uib-carousel active="<?php echo $active; ?>" interval="5000">
	<!-- Wrapper for slides -->
	<?php foreach ($photos as $index => $photo) : ?>
		<uib-slide index="<?php echo $index ?>">
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
						'alt' => __d('photo_albums', 'Photo'),
						'style' => 'display: inline'
					)
				);
			?>
			<div class="carousel-caption">
				<?php echo $photo['PhotoAlbumPhoto']['description'] ?>
			</div>
		</uib-slide>
	<?php endforeach; ?>
</uib-carousel>
