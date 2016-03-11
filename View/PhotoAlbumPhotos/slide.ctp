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

<h2>アルバムのタイトル</h2>
<div style="margin:0 20px 30px;">
アルバムの説明<br>
・・・・・・・・<br>
・・・・・・・・・・
</div>

<carousel interval="5000">
	<!-- Wrapper for slides -->
	<?php foreach ($photos as $index => $photo) : ?>
		<slide>
			<img src="<?php echo $photo['PhotoAlbumPhoto']['src'] ?>" style="margin:auto;">
			<div class="carousel-caption">
				<?php echo $photo['PhotoAlbumPhoto']['title'] ?>
			</div>
		</slide>
	<?php endforeach; ?>
</carousel>
