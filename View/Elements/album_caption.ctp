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


<h4 class="photo-albums-album-list-caption"><?php echo h($album['PhotoAlbum']['name']); ?></h4>
<?php echo $this->Workflow->label($album['PhotoAlbum']['status']); ?>
<p class="photo-albums-description">
	<?php echo h($album['PhotoAlbum']['description']); ?>
</p>

<div class="clearfix">
	<div class='pull-left'>
		<div class="label label-info"><?php echo __d('photo_albums', '%s photos', $album['PhotoAlbum']['photo_count']); ?></div>
		<?php
			if (Current::permission('content_publishable') &&
				$album['PhotoAlbum']['pending_photo_count']
			) {
				echo '<div class="label label-warning">' .
					__d('photo_albums', '%s pending approval', $album['PhotoAlbum']['pending_photo_count']) .
					'</div>';
			}
			// 改行分の隙間空ける
		?>
		<?php
			if (Current::permission('photo_albums_photo_creatable') &&
				$album['PhotoAlbum']['disapproved_photo_count']
			) {
				echo '<div class="label label-warning">' .
					__d('photo_albums', '%s denied', $album['PhotoAlbum']['disapproved_photo_count']) .
					'</div>';
			}
		?>
	</div>
	<div class='pull-right'>
		<div class="label"><?php echo $this->DisplayUser->handleLink($album); ?></div>
		<div class="label"><?php echo $this->Date->dateFormat($album['PhotoAlbum']['modified']); ?></div>
	</div>
</div>
