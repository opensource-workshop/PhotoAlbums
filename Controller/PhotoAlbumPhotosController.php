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
		'PhotoAlbums.PhotoAlbum',
		'PhotoAlbums.PhotoAlbumPhoto',
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
		'PhotoAlbums.PhotoAlbumPhotos',
		'Files.Download'
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
		$conditions = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$conditions['PhotoAlbumPhoto.album_key'] = $this->request->params['pass'][1];

		$this->Paginator->settings = array(
			'PhotoAlbumPhoto' => array(
				'order' => array('PhotoAlbumPhoto.id' => 'desc'),
				'conditions' => $conditions
			)
		);
		$this->set('photos', $this->Paginator->paginate('PhotoAlbumPhoto'));
		$this->set('albumKey', $this->request->params['pass'][1]);
	}

/**
 * index method
 *
 * @return void
 */
	public function slide() {
		$conditions = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$conditions['PhotoAlbumPhoto.album_key'] = $this->request->params['pass'][1];

		$this->Paginator->settings = array(
				'PhotoAlbumPhoto' => array(
						'order' => array('PhotoAlbumPhoto.id' => 'desc'),
						'conditions' => $conditions
				)
		);
		$this->set('photos', $this->Paginator->paginate('PhotoAlbumPhoto'));
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
					array(
						'controller' => 'photo_album_photos',
						'action' => 'index',
						Current::read('Block.id'),
						$this->request->params['pass'][1],
						'?' => array('frame_id' => Current::read('Frame.id'))
					)
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
	public function edit() {
		$this->layout = 'NetCommons.modal';
		$this->view = 'PhotoAlbums.PhotoAlbumPhotos/add';
		$id = $this->request->params['pass'][2];

		if (!$this->PhotoAlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['PhotoAlbumPhoto']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbumPhoto->savePhoto($this->request->data)) {
				$this->redirect(
					array(
						'controller' => 'photo_album_photos',
						'action' => 'index',
						Current::read('Block.id'),
						$this->request->params['pass'][1],
						'?' => array('frame_id' => Current::read('Frame.id'))
					)
				);
			}
		} else {
			$options = array('conditions' => array('PhotoAlbumPhoto.' . $this->PhotoAlbumPhoto->primaryKey => $id));
			$this->request->data = $this->PhotoAlbumPhoto->find('first', $options);
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


/**
 * photo method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function photo($options = array()) {
		App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');

		return $this->Download->doDownload($this->request->params['pass'][2], ['field' => PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME]);
	}

}
