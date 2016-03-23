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
		'PhotoAlbums.PhotoAlbumFrameSetting',
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'Paginator',
		'Security'
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
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// ↓ブロックの設計次第でComponent共通化
		// 　　→ブロックは1個保持する
		//　　　　→ルームのパーミッションで権限を保持すると拡張性がなくなるため。
		$conditions = $this->PhotoAlbum->getWorkflowConditions();
		$conditions['PhotoAlbum.block_id'] = Current::read('Block.id');
		$conditions['PhotoAlbum.key'] = array();	// ←表示チェックついているアルバムを指定

		$this->Paginator->settings = array(
			'PhotoAlbum' => array(
				'order' => array('PhotoAlbum.id' => 'desc'),
				'conditions' => $conditions
			)
		);

		$albums = $this->Paginator->paginate('PhotoAlbum');
		// ↑ここまで

		$this->set('albums', $albums);

		$this->set('frameSetting', $this->PhotoAlbumFrameSetting->getPhotoAlbumFrameSetting());
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
		$album = $this->PhotoAlbum->create();
		if ($this->request->is('post')) {
			$this->request->data['PhotoAlbum']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbum->saveAlbum($this->request->data)) {
				$this->redirect(
					// TODO 写真の追加ページへ
					NetCommonsUrl::backToPageUrl()
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
		if (!$this->PhotoAlbum->exists($id)) {
			throw new NotFoundException(__('Invalid photo album'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PhotoAlbum->save($this->request->data)) {
				return $this->flash(__('The photo album has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PhotoAlbum.' . $this->PhotoAlbum->primaryKey => $id));
			$this->request->data = $this->PhotoAlbum->find('first', $options);
		}
		$trackableCreators = $this->PhotoAlbum->TrackableCreator->find('list');
		$trackableUpdaters = $this->PhotoAlbum->TrackableUpdater->find('list');
		$this->set(compact('trackableCreators', 'trackableUpdaters'));
	}

/**
 * delete method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function delete($id = null) {
		$this->PhotoAlbum->id = $id;
		if (!$this->PhotoAlbum->exists()) {
			throw new NotFoundException(__('Invalid photo album'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PhotoAlbum->delete()) {
			return $this->flash(__('The photo album has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The photo album could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
