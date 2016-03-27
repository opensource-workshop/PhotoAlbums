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
 * PhotoAlbumPhotos Controller
 *
 * @property PhotoAlbumPhoto $PhotoAlbumPhoto
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 */
class PhotoAlbumPhotosController extends PhotoAlbumsAppController {

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbumPhoto',
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Workflow.Workflow',
		'PhotoAlbums.PhotoAlbumPhotos',
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PhotoAlbumPhoto->recursive = 0;
		$this->set('photoAlbumPhotos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function view($id = null) {
		if (!$this->PhotoAlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
		$options = array('conditions' => array('PhotoAlbumPhoto.' . $this->PhotoAlbumPhoto->primaryKey => $id));
		$this->set('photoAlbumPhoto', $this->PhotoAlbumPhoto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'NetCommons.modal';

		$photo = $this->PhotoAlbumPhoto->create();
		if ($this->request->is('post')) {
			$this->request->data['PhotoAlbumPhoto']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbumPhoto->savePhoto($this->request->data)) {
				$this->redirect(
					// TODO 写真の追加ページへ
					NetCommonsUrl::backToPageUrl()
				);
			}
		} else {
			$this->request->data = $photo;
			$this->request->data['PhotoAlbumPhoto']['album_key'] = $this->request->params['pass'][1];
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
		if (!$this->PhotoAlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PhotoAlbumPhoto->save($this->request->data)) {
				return $this->flash(__('The photo album photo has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('PhotoAlbumPhoto.' . $this->PhotoAlbumPhoto->primaryKey => $id));
			$this->request->data = $this->PhotoAlbumPhoto->find('first', $options);
		}
		$trackableCreators = $this->PhotoAlbumPhoto->TrackableCreator->find('list');
		$trackableUpdaters = $this->PhotoAlbumPhoto->TrackableUpdater->find('list');
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
		$this->PhotoAlbumPhoto->id = $id;
		if (!$this->PhotoAlbumPhoto->exists()) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PhotoAlbumPhoto->delete()) {
			return $this->flash(__('The photo album photo has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The photo album photo could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}
