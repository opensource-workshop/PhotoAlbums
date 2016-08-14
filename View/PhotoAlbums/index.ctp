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
<?php echo $this->NetCommonsHtml->css('/photo_albums/css/photo_albums.css'); ?>

<?php
	echo $this->element('PhotoAlbums.album_list_operation');

	if (empty($albums)) {
		echo '<article class="nc-not-found">' . h(__d('photo_albums', 'Album data not found')) . '</article>';
	} else {
		echo $this->element('PhotoAlbums.album_list');
	}
