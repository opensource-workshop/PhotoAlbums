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
		'PhotoAlbums.PhotoAlbumFrameSetting',
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.Permission' => array(
			'allow' => array(
				'add,edit,delete' => 'photo_albums_photo_creatable',
				'publish' => 'content_publishable',
			),
		),
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
		'NetCommons.DisplayNumber',
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$frameSetting = $this->PhotoAlbumFrameSetting->getFrameSetting();
		$this->set('frameSetting', $frameSetting);

		$conditions = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$conditions['PhotoAlbumPhoto.album_key'] = $this->request->params['pass'][1];
		$status = Hash::get($this->request->params, ['named', 'status']);
		if ($status) {
			$conditions['PhotoAlbumPhoto.status'] = $status;
		}

		$this->Paginator->settings = array(
			'PhotoAlbumPhoto' => array(
				'sort' => $frameSetting['PhotoAlbumFrameSetting']['photos_sort'],
				'direction' => $frameSetting['PhotoAlbumFrameSetting']['photos_direction'],
				'conditions' => $conditions
			)
		);
		$this->set('photos', $this->Paginator->paginate('PhotoAlbumPhoto'));
	}

/**
 * index method
 *
 * @return void
 */
	public function slide() {
		$frameSetting = $this->PhotoAlbumFrameSetting->getFrameSetting();
		$this->set('frameSetting', $frameSetting);

		$conditions = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$conditions['PhotoAlbumPhoto.album_key'] = $this->request->params['pass'][1];

		$this->Paginator->settings = array(
			'PhotoAlbumPhoto' => array(
				'sort' => $frameSetting['PhotoAlbumFrameSetting']['photos_sort'],
				'direction' => $frameSetting['PhotoAlbumFrameSetting']['photos_direction'],
				'conditions' => $conditions
			)
		);
		$this->set('photos', $this->Paginator->paginate('PhotoAlbumPhoto'));
		$this->set('active', Hash::get($this->request->params['pass'], 2));
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
		$this->view = 'edit';

		$photo = $this->PhotoAlbumPhoto->create();
		if ($this->request->is('post')) {
			$this->request->data['PhotoAlbumPhoto']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbumPhoto->savePhoto($this->request->data)) {
				$this->redirect(
					array(
						'plugin' => 'photo_albums',
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
 * @throws NotFoundException
 * @return void
 */
	public function edit() {
		$query = array(
			'conditions' => $this->PhotoAlbumPhoto->getWorkflowConditions() + array(
				'PhotoAlbumPhoto.album_key' => $this->request->params['pass'][1],
				'PhotoAlbumPhoto.key' => $this->request->params['pass'][2]
			),
			'recursive' => -1,
		);
		$photo = $this->PhotoAlbumPhoto->find('first', $query);

		if (! $this->PhotoAlbumPhoto->canEditWorkflowContent($photo)) {
			$this->throwBadRequest();
			return false;
		}

		if (!$photo) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$data['PhotoAlbumPhoto']['status'] = $this->Workflow->parseStatus();
			if ($this->PhotoAlbumPhoto->savePhoto($data)) {
				$this->redirect(
					array(
						'plugin' => 'photo_albums',
						'controller' => 'photo_album_photos',
						'action' => 'index',
						Current::read('Block.id'),
						$this->request->params['pass'][1],
						'?' => array('frame_id' => Current::read('Frame.id'))
					)
				);
			}
			$this->NetCommons->handleValidationError($this->PhotoAlbum->validationErrors);
		} else {
			$this->request->data = $photo;
		}

		$comments = $this->PhotoAlbumPhoto->getCommentsByContentKey($this->request->data['PhotoAlbumPhoto']['key']);
		$this->set('comments', $comments);
	}

/**
 * publish method
 *
 * @throws NotFoundException
 * @return void
 */
	public function publish() {
		if (!$this->request->is(array('post', 'put'))) {
			$this->throwBadRequest();
			return;
		}

		$query = array(
			'conditions' => array(
				'PhotoAlbumPhoto.album_key' => $this->request->params['pass'][1],
				'PhotoAlbumPhoto.id' => Hash::extract($this->request->data, 'PhotoAlbumPhoto.{n}.id')
			),
			'recursive' => -1,
			//'callbacks' => 'before',
		);
		$photos = $this->PhotoAlbumPhoto->find('all', $query);

		if (!$this->PhotoAlbumPhoto->publish($photos)) {
			$this->throwBadRequest();
			return;
		}

		$this->redirect(
			array(
				'plugin' => 'photo_albums',
				'controller' => 'photo_album_photos',
				'action' => 'index',
				Current::read('Block.id'),
				$this->request->params['pass'][1],
				'?' => array('frame_id' => Current::read('Frame.id'))
			)
		);
	}

/**
 * photo method
 *
 * @throws NotFoundException
 * @return void
 */
	public function photo() {
		App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');

		return $this->Download->doDownload($this->request->params['pass'][2], ['field' => PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME]);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @return void
 */
	public function delete() {
		if (!$this->request->is(array('post', 'delete'))) {
			$this->throwBadRequest();
			return;
		}

		$query = array(
			'conditions' => $this->PhotoAlbumPhoto->getWorkflowConditions() + array(
				'PhotoAlbumPhoto.album_key' => $this->request->params['pass'][1],
				'PhotoAlbumPhoto.key' => $this->request->params['pass'][2]
			),
			'recursive' => -1,
		);
		$photo = $this->PhotoAlbumPhoto->find('first', $query);

		if (!$this->PhotoAlbumPhoto->canDeleteWorkflowContent($photo)) {
			$this->throwBadRequest();
			return false;
		}

		if (!$this->PhotoAlbumPhoto->deletePhoto($photo)) {
			$this->throwBadRequest();
			return;
		}

		$this->redirect(NetCommonsUrl::backToPageUrl());
	}
}
