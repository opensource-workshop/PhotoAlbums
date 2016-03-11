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
		'PhotoAlbums.PhotoAlbumFrameSetting',
		'PhotoAlbums.PhotoAlbumDisplayAlbum'
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
				'frame_settings',
				'role_permissions',
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
			if ($this->PhotoAlbumFrameSetting->savePhotoAlbumFrameSetting($this->data)) {
				$this->redirect(NetCommonsUrl::backToPageUrl());
				return;
			}
			$this->NetCommons->handleValidationError($this->PhotoAlbumFrameSetting->validationErrors);
		} else {
			$this->data =  $this->PhotoAlbumFrameSetting->getFrameSetting();

			$query = array(
				'fields' => array('PhotoAlbumDisplayAlbum.album_key'),
				'conditions' => array(
					'frame_key' => Current::read('Frame.key')
				),
				'recursive' => -1
			);
			$this->data += $this->PhotoAlbumDisplayAlbum->find('list', $query);
		}

		$conditions = $this->PhotoAlbum->getWorkflowConditions();
		$conditions['PhotoAlbum.block_id'] = Current::read('Block.id');
		$this->Paginator->settings = array(
			'PhotoAlbum' => array(
				'order' => array('PhotoAlbum.id' => 'desc'),
				'conditions' => $conditions
			)
		);
		$this->set('albums', $this->Paginator->paginate('PhotoAlbum'));

	}
}
