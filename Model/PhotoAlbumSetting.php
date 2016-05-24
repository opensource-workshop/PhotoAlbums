<?php
/**
 * PhotoAlbumSetting Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');
App::uses('Current', 'NetCommons.Utility');

/**
 * Summary for PhotoAlbumSetting Model
 */
class PhotoAlbumSetting extends PhotoAlbumsAppModel {

/**
 * List of behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Blocks.Block',
		'Blocks.BlockRolePermission',
	);

/**
 * beforeValidate
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/ja/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'use_workflow' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.') . 'use_workflow',
				),
			),
			'use_like' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.') . 'use_like',
				),
			),
			'use_unlike' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.') . 'use_unlike',
				),
			),
			'use_comment' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.') . 'use_comment',
				),
			),
			'use_comment_approval' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.') . 'use_comment_approval',
				),
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * Get PhotoAlbumSetting data
 * If not exists, call create method for set default data
 *
 * @return array PhotoAlbumSetting data
 */
	public function getSetting() {
		$data = array(
			'block_key' => Current::read('Block.key'),
		);
		$query = array(
			'conditions' => $data,
			'recursive' => -1
		);
		$blockSetting = $this->find('first', $query);

		if (!$blockSetting) {
			$blockSetting = $this->create();
		}

		return $blockSetting;
	}

/**
 * Save PhotoAlbumSetting
 *
 * @param array $data Data to save
 * @return mixed On success Model::$data if its not empty or true, false on failure
 * @throws InternalErrorException
 */
	public function savePhotoAlbumSetting($data) {
		$this->begin();

		$this->set($data);
		if (!$this->validates()) {
			$this->rollback();
			return false;
		}

		try {
			if (!$this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return true;
	}
}
