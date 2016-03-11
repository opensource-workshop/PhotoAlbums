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
			'PhotoAlbums.PhotoAlbum'
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
		'Workflow.Workflow',
	);

/**
 * index method
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

		if ($this->request->is('post')) {
			//登録処理


		} else {
			//表示処理(初期データセット)
			$this->request->data = $this->PhotoAlbum->createAll();
			//$this->request->data['Frame'] = Current::read('Frame');
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
				$this->view = 'edit';

		if ($this->request->is('post')) {
			//登録処理


		} else {
			//表示処理(初期データセット)
			$this->request->data = $this->PhotoAlbum->createAll();
			//$this->request->data['Frame'] = Current::read('Frame');
		}
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
			$this->Session->setFlash(__('The photo album has been deleted.'));
		} else {
			$this->Session->setFlash(__('The photo album could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
