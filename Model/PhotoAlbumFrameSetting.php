<?php
/**
 * PhotoAlbumFrameSetting Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');

/**
 * Summary for PhotoAlbumFrameSetting Model
 */
class PhotoAlbumFrameSetting extends PhotoAlbumsAppModel {

/**
 * List of behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Frames.FrameSetting',
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'frame_key' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					//'message' => 'Your custom message here',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'display_type' => array(
				'inList' => array(
					'rule' => array('inList', array(PhotoAlbumsComponent::DISPLAY_TYPE_SINGLE, PhotoAlbumsComponent::DISPLAY_TYPE_LIST)),
					'message' => __d('net_commons', 'Invalid request.'),
				),
			),
			'display_num_per_page' => array(
				'inList' => array(
					'rule' => array('inList', array_keys(PhotoAlbumsComponent::getDisplayNumberOptions())),
					'message' => __d('net_commons', 'Invalid request.'),
				),
			),
			'sort_type' => array(
				'inList' => array(
					'rule' => array('inList', array_keys(PhotoAlbumsComponent::getSortOrders())),
					'message' => __d('net_commons', 'Invalid request.'),
				),
			),
		));

		parent::beforeValidate($options);

		return true;
	}

/**
 * getPhotoAlbumFrameSettingConditions 指定されたframe_keyの設定要件をSQL検索用の配列で取り出す
 *
 * @param string $frameKey frame key
 * @return array ... displayNum sortField sortDirection
 */
	public function getPhotoAlbumFrameSettingConditions($frameKey) {
		list(, $limit, $sort, $dir) = $this->getPhotoAlbumFrameSetting($frameKey);
		return array(
			'offset' => 0,
			'limit' => $limit,
			'order' => 'PhotoAlbum.' . $sort . ' ' . $dir);
	}
/**
 * getFrameSetting 指定されたframe_keyの設定要件を取り出す
 *
 * @param string $frameKey frame key
 * @return array ... displayNum sortField sortDirection
 */
	public function getPhotoAlbumFrameSetting($frameKey) {
		$frameSetting = $this->find('first', array(
			'conditions' => array(
				'frame_key' => $frameKey
			),
			'recursive' => -1
		));
		// 指定されたフレーム設定が存在しない場合
		if (! $frameSetting) {
			// とりあえずデフォルトの表示設定を返す
			// しかし、表示対象アンケートが設定されていないわけなので、空っぽの一覧表示となる
			$frameSetting = $this->getDefaultFrameSetting();
		}

		$setting = $frameSetting['PhotoAlbumFrameSetting'];
		$displayType = $setting['display_type'];
		$displayNum = $setting['display_num_per_page'];
		if ($setting['sort_type'] == PhotoAlbumsComponent::QUESTIONNAIRE_SORT_MODIFIED) {
			$sort = 'modified';
			$dir = 'DESC';
		} elseif ($setting['sort_type'] == PhotoAlbumsComponent::QUESTIONNAIRE_SORT_CREATED) {
			$sort = 'created';
			$dir = 'ASC';
		} elseif ($setting['sort_type'] == PhotoAlbumsComponent::QUESTIONNAIRE_SORT_TITLE) {
			$sort = 'title';
			$dir = 'ASC';
		} elseif ($setting['sort_type'] == PhotoAlbumsComponent::QUESTIONNAIRE_SORT_END) {
			$sort = 'publish_end';
			$dir = 'ASC';
		}
		return array($displayType, $displayNum, $sort, $dir);
	}

/**
 * getDefaultFrameSetting
 * return default frame setting
 *
 * @return array
 */
	public function getDefaultFrameSetting() {
		$frame = array(
			'PhotoAlbumFrameSetting' => array(
				//'id' => '',
				'display_type' => PhotoAlbumsComponent::DISPLAY_TYPE_LIST,
				'display_num_per_page' => PhotoAlbumsComponent::QUESTIONNAIRE_DEFAULT_DISPLAY_NUM_PER_PAGE,
				'sort_type' => PhotoAlbumsComponent::DISPLAY_SORT_TYPE_NEW_ARRIVALS,
			)
		);
		return $frame;
	}

/**
 * saveFrameSettings
 *
 * @param array $data save data
 * @return bool
 * @throws InternalErrorException
 */
	public function saveFrameSettings($data) {
		$this->loadModels([
			'PhotoAlbumFrameDisplayPhotoAlbum' => 'PhotoAlbums.PhotoAlbumFrameDisplayPhotoAlbum',
		]);

		//トランザクションBegin
		$this->begin();
		try {
			// フレーム設定のバリデート
			$this->create();
			$this->set($data);
			if (! $this->validates()) {
				return false;
			}

			// フレームに表示するアンケート一覧設定のバリデート
			// 一覧表示タイプと単独表示タイプ
			if (isset($data['PhotoAlbumFrameDisplayPhotoAlbums'])) {
				$ret = $this->PhotoAlbumFrameDisplayPhotoAlbum->validateFrameDisplayPhotoAlbum($data);
				if ($ret === false) {
					return false;
				}
			}
			// フレーム設定の登録
			if (! $this->save($data, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			// フレームに表示するアンケート一覧設定の登録
			// 一覧表示タイプと単独表示タイプ
			if (isset($data['PhotoAlbumFrameDisplayPhotoAlbums'])) {
				$ret = $this->PhotoAlbumFrameDisplayPhotoAlbum->saveFrameDisplayPhotoAlbum($data);
				if ($ret === false) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
			//トランザクションCommit
			$this->commit();
		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback();
			CakeLog::error($ex);
			throw $ex;
		}

		return true;
	}
}