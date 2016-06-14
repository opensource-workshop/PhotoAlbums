<?php
/**
 * PhotoAlbum album album caption
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

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

<div class="photo-albums-album-list-information small">
	<span>
		<?php echo __d('photo_albums', '%s photos', $album['PhotoAlbum']['photo_count']); ?>
	</span>
	<span>
		<?php echo $this->Date->dateFormat($album['PhotoAlbum']['modified']); ?>
	</span>
	<span>
		<?php echo $this->DisplayUser->handleLink($album, array('avatar' => true)); ?>
	</span>
</div>

<p class="photo-albums-description">
	<?php echo h($album['PhotoAlbum']['description']); ?>
</p>

