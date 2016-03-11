<?php
/**
 * PhotoAlbums Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppController', 'Controller');

/**
 * PhotoAlbumsController
 *
 * @author Allcreator <info@allcreator.net>
 * @package NetCommons\PhotoAlbums\Controller
 */
class PhotoAlbumsController extends PhotoAlbumsAppController {

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbumFrameSetting',
		'PhotoAlbums.PhotoAlbumFrameDisplayPhotoAlbum',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit,delete' => 'content_creatable',
			),
		),
		'PhotoAlbums.PhotoAlbums',
		'PhotoAlbums.PhotoAlbumsOwnAnswer',
		'Paginator',
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Workflow.Workflow',
		'NetCommons.Date',
		'NetCommons.DisplayNumber',
		'NetCommons.Button',
		'PhotoAlbums.PhotoAlbumStatusLabel',
		'PhotoAlbums.PhotoAlbumUtil'
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// 表示方法設定値取得
		list(, $displayNum, $sort, $dir) =
			$this->PhotoAlbumFrameSetting->getPhotoAlbumFrameSetting(Current::read('Frame.key'));

		// 条件設定値取得
		$conditions = $this->PhotoAlbum->getCondition();

		// データ取得
		$this->Paginator->settings = array_merge(
			$this->Paginator->settings,
			array(
				'conditions' => $conditions,
				'page' => 1,
				'sort' => $sort,
				'limit' => $displayNum,
				'direction' => $dir,
				'recursive' => 0,
			)
		);
		if (!isset($this->params['named']['answer_status'])) {
			$this->request->params['named']['answer_status'] = PhotoAlbumsComponent::QUESTIONNAIRE_ANSWER_VIEW_ALL;
		}
		$photoAlbum = $this->paginate('PhotoAlbum', $this->_getPaginateFilter());
		$this->set('photoAlbums', $photoAlbum);

		$this->__setOwnAnsweredKeys();

		if (count($photoAlbum) == 0) {
			$this->view = 'PhotoAlbums/noPhotoAlbum';
		}
	}

/**
 * _getPaginateFilter method
 *
 * @return array
 */
	protected function _getPaginateFilter() {
		$filter = array();

		if ($this->request->params['named']['answer_status'] == PhotoAlbumsComponent::QUESTIONNAIRE_ANSWER_TEST) {
			$filter = array(
				'PhotoAlbum.status !=' => WorkflowComponent::STATUS_PUBLISHED
			);
			return $filter;
		}

		$filterCondition = array('PhotoAlbum.key' => $this->PhotoAlbumsOwnAnswer->getOwnAnsweredKeys());
		if ($this->request->params['named']['answer_status'] == PhotoAlbumsComponent::QUESTIONNAIRE_ANSWER_UNANSWERED) {
			$filter = array(
				'NOT' => $filterCondition
			);
		} elseif ($this->request->params['named']['answer_status'] == PhotoAlbumsComponent::QUESTIONNAIRE_ANSWER_ANSWERED) {
			$filter = array(
				$filterCondition
			);
		}

		return $filter;
	}

/**
 * Set view value of answered photoAlbum keys
 *
 * @return void
 */
	private function __setOwnAnsweredKeys() {
		if ($this->request->params['named']['answer_status'] == PhotoAlbumsComponent::QUESTIONNAIRE_ANSWER_UNANSWERED) {
			$this->set('ownAnsweredKeys', array());

			return;
		}

		$this->set('ownAnsweredKeys', $this->PhotoAlbumsOwnAnswer->getOwnAnsweredKeys());
	}

}