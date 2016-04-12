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

<h2><?php echo $album['PhotoAlbum']['name']; ?></h2>
<p>
<?php echo $album['PhotoAlbum']['description']; ?>
</p>

<carousel interval="5000">
	<!-- Wrapper for slides -->
	<?php foreach ($photos as $index => $photo) : ?>
		<slide>
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
		</slide>
	<?php endforeach; ?>
</carousel>
