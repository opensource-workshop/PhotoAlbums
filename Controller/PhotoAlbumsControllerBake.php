<?php
/**
 * PhotoAlbums Controller
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 * PhotoAlbums Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @property PhotoAlbum $PhotoAlbum
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SecurityComponent $Security
 * @property SessionComponent $Session
 *
 */
class PhotoAlbumsController extends PhotoAlbumsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Security', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PhotoAlbum->recursive = 0;
		$this->set('photoAlbums', $this->Paginator->paginate());
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
		if ($this->request->is('post')) {
			$this->PhotoAlbum->create();
			if ($this->PhotoAlbum->save($this->request->data)) {
				$this->Session->setFlash(__('The photo album has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo album could not be saved. Please, try again.'));
			}
		}
		$blocks = $this->PhotoAlbum->Block->find('list');
		$trackableCreators = $this->PhotoAlbum->TrackableCreator->find('list');
		$trackableUpdaters = $this->PhotoAlbum->TrackableUpdater->find('list');
		$this->set(compact('blocks', 'trackableCreators', 'trackableUpdaters'));
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
				$this->Session->setFlash(__('The photo album has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo album could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PhotoAlbum.' . $this->PhotoAlbum->primaryKey => $id));
			$this->request->data = $this->PhotoAlbum->find('first', $options);
		}
		$blocks = $this->PhotoAlbum->Block->find('list');
		$trackableCreators = $this->PhotoAlbum->TrackableCreator->find('list');
		$trackableUpdaters = $this->PhotoAlbum->TrackableUpdater->find('list');
		$this->set(compact('blocks', 'trackableCreators', 'trackableUpdaters'));
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
