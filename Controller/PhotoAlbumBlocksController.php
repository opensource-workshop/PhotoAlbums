<?php
/**
 * PhotoAlbumBlocks Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 * PhotoAlbumBlocks Controller
 *
 */
class PhotoAlbumBlocksController extends PhotoAlbumsAppController {

/**
 * layout
 *
 * @var array
 */
	//public $layout = 'Pages.default';
	public $layout = 'NetCommons.setting';


/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbum'
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'index,add,edit,delete' => 'block_editable',
			),
		),
		'Paginator'
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'role_permissions' => true,
			)
		),
		'NetCommons.Button',
		'NetCommons.Date',
		'Workflow.Workflow',
	);

/**
 * index
 *
 * @return void
 */
	public function index() {
		// ↓ブロックの設計次第でComponent共通化
		$this->Paginator->settings = array(
			'PhotoAlbum' => array(
				'order' => array('PhotoAlbum.id' => 'desc'),
				'conditions' => $this->PhotoAlbum->getBlockConditions(),
			)
		);

		$albums = $this->Paginator->paginate('PhotoAlbum');
		// ↑ここまで

		$albums = $this->getDummy();
		if (! $albums) {
			$this->view = 'Blocks.Blocks/not_found';
			return;
		}
		$this->set('albums', $albums);
	}

/**
 * add
 *
 * @return void
 */
	public function add() {
		$this->view = 'edit';

		if ($this->request->is('post')) {
			//登録処理


		} else {
			//表示処理(初期データセット)
			$this->request->data = $this->PhotoAlbum->createAll();
			//$this->request->data['Frame'] = Current::read('Frame');
		}
	}

	public function getDummy() {
		$dummy = array (
			array(
				'PhotoAlbum' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'language_id' => '2',
					'jacket' => 'athletic_meet.jpg',	// ファイルアップロードプラグイン調査
					'description' => '',
					'photo_count' => '23',	// バーチャルフィールド
					'status' => 1,
					'isEdit' => false,	// demo用
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'Block' => array(
					'id' => '0',
					'language_id' => '2',
					'room_id' => '1',
					'plugin_key' => 'photo_albums',
					'key' => '',
					'name' => '運動会',
					'public_type' => '1',
					'from' => null,
					'to' => null,
					'translation_engine' => '',
					'is_auto_translated' => false,
					'is_first_auto_translation' => false,
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'TrackableCreator' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
			),

			array(
				'PhotoAlbum' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'language_id' => '2',
					'jacket' => 'school_trip.jpg',	// ファイルアップロードプラグイン調査
					'description' => 'アルバムの説明文です。アルバムの説明文です。アルバムの説明文です<br />・・・・・・・・・',
					'photo_count' => '35',	// バーチャルフィールド
					'status' => 2,
					'isEdit' => true,	// demo用
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'Block' => array(
					'id' => '0',
					'language_id' => '2',
					'room_id' => '1',
					'plugin_key' => 'photo_albums',
					'key' => '',
					'name' => '修学旅行',
					'public_type' => '1',
					'from' => null,
					'to' => null,
					'translation_engine' => '',
					'is_auto_translated' => false,
					'is_first_auto_translation' => false,
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'TrackableCreator' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
			),

			array(
				'PhotoAlbum' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'language_id' => '2',
					'jacket' => 'school_canpionship.jpg',	// ファイルアップロードプラグイン調査
					'description' => '',
					'photo_count' => '57',	// バーチャルフィールド
					'status' => 1,
					'isEdit' => false,	// demo用
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'Block' => array(
					'id' => '0',
					'language_id' => '2',
					'room_id' => '1',
					'plugin_key' => 'photo_albums',
					'key' => '',
					'name' => 'インターハイ',
					'public_type' => '1',
					'from' => null,
					'to' => null,
					'translation_engine' => '',
					'is_auto_translated' => false,
					'is_first_auto_translation' => false,
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'TrackableCreator' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
			),

			array(
				'PhotoAlbum' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'language_id' => '2',
					'jacket' => 'school_festival.jpg',	// ファイルアップロードプラグイン調査
					'description' => 'アルバムの説明文です<br />・・・・・・・・・',
					'photo_count' => '38',	// バーチャルフィールド
					'status' => 3,
					'isEdit' => true,	// demo用
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'Block' => array(
					'id' => '0',
					'language_id' => '2',
					'room_id' => '1',
					'plugin_key' => 'photo_albums',
					'key' => '',
					'name' => '文化祭',
					'public_type' => '1',
					'from' => null,
					'to' => null,
					'translation_engine' => '',
					'is_auto_translated' => false,
					'is_first_auto_translation' => false,
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'TrackableCreator' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
			),

			array(
				'PhotoAlbum' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'language_id' => '2',
					'jacket' => 'school.jpg',	// ファイルアップロードプラグイン調査
					'description' => '',
					'photo_count' => '13',	// バーチャルフィールド
					'status' => 4,
					'isEdit' => true,	// demo用
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
					'modified' => '2015-11-10 07:59:48',
				),
				'Block' => array(
					'id' => '0',
					'language_id' => '2',
					'room_id' => '1',
					'plugin_key' => 'photo_albums',
					'key' => '',
					'name' => '校内の様子',
					'public_type' => '1',
					'from' => null,
					'to' => null,
					'translation_engine' => '',
					'is_auto_translated' => false,
					'is_first_auto_translation' => false,
					'created_user' => '1',
					'created' => '2015-11-10 07:59:48',
					'modified_user' => '1',
						'modified' => '2015-11-10 07:59:48',
				),
				'TrackableCreator' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => 'ハンドル名'
				),
			),

		);

		return $dummy;
	}
}
