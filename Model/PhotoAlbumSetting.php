<?php
/**
 * PhotoAlbumSetting Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Current', 'NetCommons.Utility');
App::uses('BlockBaseModel', 'Blocks.Model');
App::uses('BlockSettingBehavior', 'Blocks.Model/Behavior');

/**
 * Summary for PhotoAlbumSetting Model
 */
class PhotoAlbumSetting extends BlockBaseModel {

/**
 * Custom database table name
 *
 * @var string
 */
	public $useTable = false;

/**
 * List of behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Blocks.Block',
		'Blocks.BlockRolePermission',
		'Blocks.BlockSetting' => array(
			BlockSettingBehavior::FIELD_USE_LIKE,
			BlockSettingBehavior::FIELD_USE_UNLIKE,
			BlockSettingBehavior::FIELD_USE_COMMENT,
			BlockSettingBehavior::FIELD_USE_WORKFLOW,
			BlockSettingBehavior::FIELD_USE_COMMENT_APPROVAL,
		),
	);

/**
 * Get PhotoAlbumSetting data
 * If not exists, call create method for set default data
 *
 * @return array PhotoAlbumSetting data
 * @see BlockSettingBehavior::getBlockSetting() 取得
 * @see BlockSettingBehavior::createBlockSetting() getBlockSetting()でデータなければ新規作成
 */
	public function getSetting() {
		return $this->getBlockSetting();
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
			// useTable = falseでsaveすると必ずfalseになるので、throwしない
			$this->save(null, false);

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return true;
	}
}
