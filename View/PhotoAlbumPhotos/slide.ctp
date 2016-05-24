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

<uib-carousel active="<?php echo $active; ?>" interval="5000">
	<!-- Wrapper for slides -->
	<?php foreach ($photos as $index => $photo) : ?>
		<uib-slide index="<?php echo $index ?>">
			<?php
				/*  imgタグ
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
				*/
			?>
			<div class="photo-albums-photo" style="background-image:url(
				<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'photo',
							Current::read('Block.id'),
							$photo['PhotoAlbumPhoto']['album_key'],
							$photo['PhotoAlbumPhoto']['id']
						)
					);
				?>
			);"></div>
			<div class="carousel-caption">
				<?php echo nl2br(h($photo['PhotoAlbumPhoto']['description'])); ?>
			</div>
		</uib-slide>
	<?php endforeach; ?>
</uib-carousel>

<?php if ($frameSetting['PhotoAlbumFrameSetting']['display_type'] != PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE): ?>
	<button class="close photo-albums-photo-slide-close" type="button"
			tooltip="<?php echo __d('net_commons', 'Close'); ?>"
			ng-click="cancel()">
		<span class="glyphicon glyphicon-remove"></span>
	</button>
<?php endif;
