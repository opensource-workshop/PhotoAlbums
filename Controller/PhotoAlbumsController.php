<?php
/**
 * PhotoAlbums Controller
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
class PhotoAlbumsController extends PhotoAlbumsAppController {

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbum',
		'PhotoAlbums.PhotoAlbumPhoto',
		'PhotoAlbums.PhotoAlbumFrameSetting',
		'PhotoAlbums.PhotoAlbumDisplayAlbum',
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'Paginator',
		'Security',
		'Workflow.Workflow',
		'Files.Download',
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Workflow.Workflow',
		'Users.DisplayUser',
		'NetCommons.DisplayNumber',
		'PhotoAlbums.PhotoAlbums',
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$frameSetting = $this->PhotoAlbumFrameSetting->getFrameSetting();
		$this->set('frameSetting', $frameSetting);

		$displayAlbum = $this->PhotoAlbumDisplayAlbum->getDisplayList();

		$conditions = $this->PhotoAlbum->getWorkflowConditions();
		$conditions['PhotoAlbum.block_id'] = Current::read('Block.id');
		$conditions['PhotoAlbum.key'] = $displayAlbum;

		$this->Paginator->settings = array(
			'PhotoAlbum' => array(
				'sort' => $frameSetting['PhotoAlbumFrameSetting']['albums_sort'],
				'direction' => $frameSetting['PhotoAlbumFrameSetting']['albums_direction'],
				'conditions' => $conditions
			)
		);
		$albums = $this->Paginator->paginate('PhotoAlbum');
		$this->set('albums', $albums);
		if (empty($albums)) {
			return;
		}

		if ($frameSetting['PhotoAlbumFrameSetting']['display_type'] != PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS ) {
			$this->set('album', $albums[0]);

			$conditions = $this->PhotoAlbumPhoto->getWorkflowConditions();
			$conditions['PhotoAlbumPhoto.album_key'] = $albums[0]['PhotoAlbum']['key'];

			$this->Paginator->settings = array(
				'PhotoAlbumPhoto' => array(
					'order' => array('PhotoAlbumPhoto.id' => 'desc'),
					'conditions' => $conditions
				)
			);
			$this->set('photos', $this->Paginator->paginate('PhotoAlbumPhoto'));
		}

		if ($frameSetting['PhotoAlbumFrameSetting']['display_type'] == PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS ) {
			$this->view = 'PhotoAlbumPhotos/index';
		}

		if ($frameSetting['PhotoAlbumFrameSetting']['display_type'] == PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE ) {
			$this->view = 'PhotoAlbumPhotos/slide';
		}
	}

/**
 * setting method
 *
 * @return void
 */
	public function setting() {
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

/**
 * view method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function view($id = null) {
		if (!$this->PhotoAlbum->exists($id)) {
			throw new NotFoundException(__('Invalid photo album'));
		}
		$options = array('conditions' => array('PhotoAlbum.' . $this->PhotoAlbum->primaryKey => $id));
		$this->set('photoAlbum', $this->PhotoAlbum->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->view = 'edit';

		$album = $this->PhotoAlbum->create();
		if ($this->request->is('post')) {
			$this->request->data['PhotoAlbum']['status'] = $this->Workflow->parseStatus();
			$album = $this->PhotoAlbum->saveAlbum($this->request->data);
			if ($album) {
				$this->redirect(
					array(
						'controller' => 'photo_album_photos',
						'action' => 'index',
						Current::read('Block.id'),
						$album['PhotoAlbum']['key'],
						'?' => array('frame_id' => Current::read('Frame.id'))
					)
				);
			}
			$this->NetCommons->handleValidationError($this->PhotoAlbum->validationErrors);
		} else {
			$this->request->data = $album;
		}
	}

/**
 * edit method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function edit($id = null) {
		$query = array(
			'conditions' => $this->PhotoAlbum->getWorkflowConditions() + array(
				'PhotoAlbum.block_id' => Current::read('Block.id'),
				'PhotoAlbum.key' => $this->request->params['pass'][1]
			),
			'recursive' => -1,
		);
		$album = $this->PhotoAlbum->find('first', $query);

		if (!$this->PhotoAlbum->canEditWorkflowContent($album)) {
			$this->throwBadRequest();
			return false;
		}

		if (!$album) {
			throw new NotFoundException(__('Invalid photo album'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['PhotoAlbum']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbum->saveAlbum($this->request->data)) {
				$this->redirect(
					array(
						'action' => 'index',
						Current::read('Block.id'),
						'?' => array('frame_id' => Current::read('Frame.id'))
					)
				);
			}
			$this->NetCommons->handleValidationError($this->PhotoAlbum->validationErrors);
		} else {
			$this->request->data = $album;
		}
	}

/**
 * jacket method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function jacket($options = array()) {
		App::uses('PhotoAlbum', 'PhotoAlbums.Model');

		return $this->Download->doDownload($this->request->params['pass'][1], ['field' => PhotoAlbum::ATTACHMENT_FIELD_NAME]);
	}

/**
 * delete method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function delete() {
		if (!$this->request->is(array('post', 'delete'))) {
			$this->throwBadRequest();
			return;
		}

		$query = array(
			'conditions' => $this->PhotoAlbum->getWorkflowConditions() + array(
				'PhotoAlbum.block_id' => Current::read('Block.id'),
				'PhotoAlbum.key' => $this->request->params['pass'][1]
			),
			'recursive' => -1,
		);
		$album = $this->PhotoAlbum->find('first', $query);

		if (!$this->PhotoAlbum->canDeleteWorkflowContent($album)) {
			$this->throwBadRequest();
			return false;
		}

		if (! $this->PhotoAlbum->deleteAlbum($album)) {
			$this->throwBadRequest();
			return;
		}

		$this->redirect(NetCommonsUrl::backToPageUrl());
	}
}
