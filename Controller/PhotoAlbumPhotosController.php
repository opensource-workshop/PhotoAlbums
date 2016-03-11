<?php
/**
 * PhotoAlbumPhotos Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 * PhotoAlbums Controller
 *
 */
class PhotoAlbumPhotosController extends PhotoAlbumsAppController {

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbum',
		'PhotoAlbums.PhotoAlbumPhoto'
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'Security'
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Workflow.Workflow',
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$photos = $this->PhotoAlbumPhoto->getWorkflowContents('all', array(
			'recursive' => 0,
			'conditions' => $conditions
		));*/
		$photos = $this->getDummy();

		$this->set('photos', $photos);
	}

/**
 * slide method
 *
 * @return void
 */
	public function slide() {
		/*$photos = $this->PhotoAlbumPhoto->getWorkflowContents('all', array(
		 'recursive' => 0,
				'conditions' => $conditions
		));*/
		$photos = $this->getDummy();

		$this->set('photos', $photos);
	}

	public function getDummy() {
		$dummy = array (
			array(
				'PhotoAlbumPhoto' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'title' => '写真タイトル',
					'src' => '/photo_albums/img/1.jpg',
					'status' => 1,
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
					'handlename' => null
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => null
				),
			),

			array(
				'PhotoAlbumPhoto' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'title' => '写真タイトル',
					'src' => '/photo_albums/img/2.jpg',
					'status' => 2,
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
					'handlename' => null
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => null
				),
			),

			array(
				'PhotoAlbumPhoto' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'title' => '写真タイトル',
					'src' => '/photo_albums/img/3.jpg',
					'status' => 3,
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
					'handlename' => null
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => null
				),
			),

			array(
				'PhotoAlbumPhoto' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'title' => '写真タイトル',
					'src' => '/photo_albums/img/4.jpg',
					'status' => 4,
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
					'handlename' => null
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => null
				),
			),

			array(
				'PhotoAlbumPhoto' => array(
					'id' => '6',
					'block_id' => '0',
					'key' => '',
					'title' => '写真タイトル',
					'src' => '/photo_albums/img/5.jpg',
					'status' => 1,
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
					'handlename' => null
				),
				'TrackableUpdater' => array(
					'id' => '1',
					'username' => 'admin',
					'handlename' => null
				),
			),

		);

		return $dummy;
	}
}
