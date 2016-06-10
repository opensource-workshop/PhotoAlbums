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
 * @throws InternalErrorException
 * @return void
 */
	public function initializeSetting() {
		$frameData = Current::read('Frame');
		if (!isset($frameData['block_id'])) {
			$Block = ClassRegistry::init('Blocks.Block');
			$query = array(
				'conditions' => array(
					'Block.room_id' => $frameData['room_id'],
					'Block.plugin_key' => $frameData['plugin_key'],
					'Block.language_id' => $frameData['language_id'],
				),
				'recursive' => -1
			);
			$blockData = $Block->find('first',$query);

			$PhotoAlbumSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumSetting');
			$data = $PhotoAlbumSetting->create();
			$data['Frame']['id'] = Current::read('Frame.id');
			$data += $blockData;
			if (!$PhotoAlbumSetting->savePhotoAlbumSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}

		$FrameSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumFrameSetting');
		$query = array(
			'conditions' => array(
				'PhotoAlbumFrameSetting.frame_key' => $frameData['key']
			),
			'recursive' => -1
		);
		if (!$FrameSetting->find('count', $query)) {
			$data = $FrameSetting->create();
			if (!$FrameSetting->savePhotoAlbumFrameSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}
	}

}
