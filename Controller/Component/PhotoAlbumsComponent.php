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
 * Constant for display type
 *
 * @var int
 */
	const SETTING_WORD = 'setting';

/**
 * Constant for display type
 *
 * @var int
 */
	private $__isSetting = false;

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @throws NotFoundException
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::startup
 */
	public function startup(Controller $controller) {
		$this->__isSetting = (
			$controller->request->params['action'] == 'setting' ||
			end($controller->request->params['pass']) == self::SETTING_WORD
		);

		if ($this->__isSetting) {
			$controller->layout = 'NetCommons.setting';
		}
	}

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param array $url Redirect url
 * @return array
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::startup
 */

	public function getRedirectUrl($url) {
		if ($this->__isSetting) {
			$url[] = self::SETTING_WORD;
		}

		return $url;
	}

/**
 * Initialize album setting and frame setting
 *
 * @param Controller $controller Controller with components to startup
 * @return bool True on setting
 */
	public function isSetting(Controller $controller) {
		return $this->__isSetting;
	}

/**
 * Initialize album setting and frame setting
 *
 * @throws InternalErrorException
 * @return void
 */
	public function initializeSetting() {
		$frame = Current::read('Frame');
		if ($frame['block_id']) {
			return;
		}

		$FrameSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumFrameSetting');
		$query = array(
			'conditions' => array(
				'PhotoAlbumFrameSetting.frame_key' => $frame['key']
			),
			'recursive' => -1
		);
		if (!$FrameSetting->find('count', $query)) {
			$data = $FrameSetting->create();
			if (!$FrameSetting->savePhotoAlbumFrameSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}

		$Block = ClassRegistry::init('Blocks.Block');
		$query = array(
			'conditions' => array(
				'Block.room_id' => $frame['room_id'],
				'Block.plugin_key' => $frame['plugin_key'],
				'Block.language_id' => $frame['language_id'],
			),
			'recursive' => -1
		);
		$block = $Block->find('first', $query);

		$PhotoAlbumSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumSetting');
		if (!$block) {
			$data = $PhotoAlbumSetting->create();
		} else {
			$query = array(
				'conditions' => array(
					'PhotoAlbumSetting.block_key' => $block['Block']['key']
				),
				'recursive' => -1
			);
			$data = $PhotoAlbumSetting->find('first', $query);
		}
		$data['Frame']['id'] = $frame['id'];
		$data += $block;

		if (!$PhotoAlbumSetting->savePhotoAlbumSetting($data)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}
	}

}
