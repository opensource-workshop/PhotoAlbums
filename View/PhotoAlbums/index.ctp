<?php
/**
 * photoAlbum content list view template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->NetCommonsHtml->script('/photo_albums/js/photo_albums.js'); ?>

<div class='text-right'>
	<?php echo $this->Workflow->addLinkButton('', null, array('tooltip' => __d('faqs', 'Create question'))); ?>
</div>

<?php
	if (empty($albums)) {
		echo h(__d('photoAlbums', 'Album data not found'));
	} else {
		switch ($frameSetting['PhotoAlbumFrameSetting']['display_type']) {
			case PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS:
				echo $this->element('PhotoAlbums.photo_list');
				break;
			case PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS:
				echo $this->element('PhotoAlbums.slide');
				break;
			default:
				echo $this->element('PhotoAlbums.album_list_operation');
				echo $this->element('PhotoAlbums.album_list');
		}
	}
?>
