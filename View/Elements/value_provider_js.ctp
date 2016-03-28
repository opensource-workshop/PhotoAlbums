<?php
/**
 * PhotoAlbum album list template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
 ?>

<?php echo $this->NetCommonsHtml->script('/photo_albums/js/photo_albums.js'); ?>

 <script>
	NetCommonsApp.value('photoAlbumsValues', {
		addUrl: '<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'add',
							Current::read('Block.id')
						)
					) . '/';
				?>',
		editUrl: '<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'edit',
							Current::read('Block.id'),
							$albumKey
						)
					) . '/';
				?>',
		slideUrl: '<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'slide',
							Current::read('Block.id')
						)
					). '/';
				?>'
	});
</script>
