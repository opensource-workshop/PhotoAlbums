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
echo $this->NetCommonsHtml->css('/photo_albums/css/photo_albums.css');
?>

<?php if ($frameSetting['PhotoAlbumFrameSetting']['display_type'] == PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS): ?>
	<button class="close photo-albums-photo-slide-close .carousel-inner" type="button"
			tooltip="<?php echo __d('net_commons', 'Close'); ?>"
			ng-click="cancel()">
		<span class="glyphicon glyphicon-remove small"></span>
	</button>
<?php endif; ?>

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
						//'style' => 'display: inline',
						'class' => 'img-responsive center-block'
					)
				);
			?>
			<div class="carousel-caption">
				<?php echo $photo['PhotoAlbumPhoto']['description'] ?>
			</div>
		</uib-slide>
	<?php endforeach; ?>
</uib-carousel>
