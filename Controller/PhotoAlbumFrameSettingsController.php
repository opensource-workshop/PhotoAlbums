<?php
/**
 * PhotoAlbumFrameSettings Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 * PhotoAlbumFrameSettings Controller
 *
 * @property PhotoAlbumFrameSetting $PhotoAlbumFrameSetting
 * @property PhotoAlbum $PhotoAlbum
 */
class PhotoAlbumFrameSettingsController extends PhotoAlbumsAppController {
/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbum',
		'PhotoAlbums.PhotoAlbumFrameSetting'
	);

/**
 * use components
 *
 * @var array
*/
	public $components = array(
		'Pages.PageLayout',
		'NetCommons.Permission' => array(
			'allow' => array(
				'edit' => 'page_editable',
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
				'block_index' => false,
				'role_permissions' => true,
			)
		),
		'NetCommons.DisplayNumber',
		'NetCommons.Date'
	);

/**
 * edit method
 *
 * @return void
*/
	public function edit() {
		if ($this->request->is(array('post', 'put'))) {
			//登録処理
		}

		$this->set('frameSetting', $this->PhotoAlbumFrameSetting->getFrameSetting());

		// ↓ブロックの設計次第でComponent共通化
		$this->Paginator->settings = array(
				'PhotoAlbum' => array(
						'order' => array('PhotoAlbum.id' => 'desc'),
						'conditions' => $this->PhotoAlbum->getBlockConditions(),
				)
		);

		$albums = $this->Paginator->paginate('PhotoAlbum');
		// ↑ここまで

		App::uses('PhotoAlbumBlocksController', 'PhotoAlbums.Controller');
		$dummyClass = new PhotoAlbumBlocksController();
		$albums = $dummyClass->getDummy();

		$this->set('albums', $albums);
	}
}
