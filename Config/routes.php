<?php
/**
 * Users routes configuration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

Router::connect(
	'/photo_albums/photo_album_photos/photo/:block_id/:key/:content_id/:size',
	array('plugin' => 'photo_albums', 'controller' => 'photo_album_photos', 'action' => 'photo'),
	array('block_id' => '[0-9]+', 'content_id' => '[0-9]+', 'size' => 'big|medium|small|thumb')
);

Router::connect(
	'/photo_albums/photo_album_photos/photo/:block_id/:key/:content_id',
	array(
		'plugin' => 'photo_albums', 'controller' => 'photo_album_photos',
		'action' => 'photo', 'size' => 'big'
	),
	array('block_id' => '[0-9]+', 'content_id' => '[0-9]+')
);

Router::connect(
	'/photo_albums/photo_albums/jacket/:block_id/:key/:field_name/:size',
	array('plugin' => 'photo_albums', 'controller' => 'photo_albums', 'action' => 'jacket'),
	array('block_id' => '[0-9]+', 'size' => 'big|medium|small|thumb')
);
