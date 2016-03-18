<?php
/**
 * PhotoAlbums Component
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Component', 'Controller');

/**
 * PhotoAlbums Component
 *
 */
class PhotoAlbumsComponent extends Component {

/**
 * Initialize album setting and frame setting
 *
 * @return void
 */
	public function initializeSetting() {
		$blockKey = Current::read('Block.key');
		if (!isset($blockKey)) {
			$photoAlbumSetting = ClassRegistry::getObject('PhotoAlbums.PhotoAlbumSetting');
			if (!$photoAlbumSetting) {
				$photoAlbumSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumSetting');
			}

			$data = $photoAlbumSetting->create();
			$data['Frame']['id'] = Current::read('Frame.id');
			if (!$photoAlbumSetting->savePhotoAlbumSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}

		$frameSetting = ClassRegistry::getObject('PhotoAlbums.PhotoAlbumFrameSetting');
		if (!$frameSetting) {
			$frameSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumFrameSetting');
		}

		$query = array(
			'conditions' => array(
				'PhotoAlbumFrameSetting.frame_key' => Current::read('Frame.key')
			),
			'recursive' => -1
		);
		if (!$frameSetting->find('count', $query)) {
			$data = $frameSetting->create();
			if (!$frameSetting->savePhotoAlbumFrameSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}
	}


/**
 * Set album data to view
 *
 * @param Controller $controller Controller
 * @param array $query find条件
 * @return void
 */
	public function setAlbums(Controller $controller, $query = array()) {

	}
}
