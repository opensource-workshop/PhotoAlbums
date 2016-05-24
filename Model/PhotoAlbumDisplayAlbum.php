<?php
/**
 * PhotoAlbumDisplayAlbum Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');
App::uses('Current', 'NetCommons.Utility');

/**
 * Summary for PhotoAlbumDisplayAlbum Model
 */
class PhotoAlbumDisplayAlbum extends PhotoAlbumsAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'master';

/**
 * Get display album key list
 *
 * @return display album key list
 */
	public function getDisplayList() {
		$query = array(
			'fields' => array('PhotoAlbumDisplayAlbum.album_key'),
			'conditions' => array(
				'frame_key' => Current::read('Frame.key')
			),
			'recursive' => -1
		);

		return $this->find('list', $query);
	}
}
