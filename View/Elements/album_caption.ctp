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

<div class="photo-albums-album-note small">
	<span>
		<?php echo __d('photo_albums', '%s photos', $album['PhotoAlbum']['photo_count']); ?>
	</span>
	<span>
		<?php echo __d('photo_albums', 'Updated date:%s', $this->Date->dateFormat($album['PhotoAlbum']['modified'])); ?>
	</span>
	<?php if ($this->request->params['controller'] == 'photo_album_photos') : ?>
		<span>
			<?php echo __d('photo_albums', 'Created date:%s', $this->Date->dateFormat($album['PhotoAlbum']['created'])); ?>
		</span>
	<?php endif; ?>
	<span>
		<?php echo $this->DisplayUser->handleLink($album, array('avatar' => true)); ?>
	</span>
</div>

<?php if ($this->request->params['controller'] == 'photo_albums') : ?>
	<p class="photo-albums-description">
		<?php echo h($album['PhotoAlbum']['description']); ?>
	</p>
<?php endif; ?>

<?php if ($this->request->params['controller'] == 'photo_album_photos' && $album['PhotoAlbum']['description']) : ?>
	<button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#photo-albums-description<?php echo $frameSetting['PhotoAlbumFrameSetting']['id']; ?>" aria-expanded="false" aria-controls="collapseExample">
		<?php echo __d('photo_albums', 'Album description'); ?>
	</button>
	<div class="collapse" id="photo-albums-description<?php echo $frameSetting['PhotoAlbumFrameSetting']['id']; ?>">
		<?php echo nl2br(h($album['PhotoAlbum']['description'])); ?>
	</div>
<?php endif;
