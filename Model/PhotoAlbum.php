<?php
/**
 * PhotoAlbum Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');

/**
 * Summary for PhotoAlbum Model
 */
class PhotoAlbum extends PhotoAlbumsAppModel {

/**
 * Field name for attachment behavior
 *
 * @var int
 */
	const ATTACHMENT_FIELD_NAME = 'jacket';

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'master';

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.OriginalKey',
		'Files.Attachment' => [PhotoAlbum::ATTACHMENT_FIELD_NAME],
		'Workflow.Workflow',
		'Workflow.WorkflowComment',
	);



/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge(
			$this->validate,
			array(
				'name' => array(
					'notBlank' => array(
						'rule' => array('notBlank'),
						'message' => __d('net_commons', 'Invalid request.'),
						'allowEmpty' => false,
						'required' => true,
					),
				),
			)
		);

		return parent::beforeValidate($options);
	}

/**
 * Called after each find operation. Can be used to modify any results returned by find().
 * Return value should be the (modified) results.
 * Set photo count data
 *
 * @param mixed $results The results of the find operation
 * @param bool $primary Whether this model is being queried directly (vs. being queried as an association)
 * @return mixed Result of the find operation
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#afterfind
 */
	public function afterFind($results, $primary = false) {
		if ($this->recursive == -1) {
			return $results;
		}
		if (empty($results)) {
			return $results;
		}
		if (!isset($results[0][$this->alias]['key']) {
			return $results;
		}

		// コンテンツコメント件数をセット
		$contents = array();
		foreach ($results as $content) {
			$contentKey = $content[$model->alias]['key'];

			$content['ContentCommentCnt'] = array(
					'content_key' => $contentKey,
					'cnt' => 0
			);
			$contents[$contentKey] = $content;
		}

		$ContentComment = ClassRegistry::init('ContentComments.ContentComment');

		$contentKeys = array_keys($contents);
		/* @see ContentComment::getConditions() */
		$conditions = $ContentComment->getConditions($contentKeys);

		// バーチャルフィールドを追加
		/* @link http://book.cakephp.org/2.0/ja/models/virtual-fields.html#sql */
		$ContentComment->virtualFields['cnt'] = 0;

		$contentCommentCnts = $ContentComment->find('all', array(
				'recursive' => -1,
				'fields' => array('content_key', 'count(content_key) as ContentComment__cnt'),	// Model__エイリアスにする
				'conditions' => $conditions,
				'group' => array('content_key'),
		));

		foreach ($contentCommentCnts as $contentCommentCnt) {
			$contentKey = $contentCommentCnt['ContentComment']['content_key'];
			$contents[$contentKey]['ContentCommentCnt']['cnt'] = $contentCommentCnt['ContentComment']['cnt'];
		}

		// 公開権限なし
		if (! Current::permission('content_comment_publishable')) {
			$results = array_values($contents);
			return $results;
		}

		// --- 未承認件数の取得
		// 未承認のみ
		$conditions['ContentComment.status'] = WorkflowComponent::STATUS_APPROVED;

		// バーチャルフィールドを追加
		$ContentComment->virtualFields['approval_cnt'] = 0;

		$approvalCnts = $ContentComment->find('all', array(
				'recursive' => -1,
				'fields' => array('content_key', 'count(content_key) as ContentComment__approval_cnt'),	// Model__エイリアスにする
				'conditions' => $conditions,
				'group' => array('content_key'),
		));

		foreach ($approvalCnts as $approvalCnt) {
			$contentKey = $approvalCnt['ContentComment']['content_key'];
			$contents[$contentKey]['ContentCommentCnt']['approval_cnt'] = $approvalCnt['ContentComment']['approval_cnt'];
		}

		$results = array_values($contents);
		return $results;
	}

/**
 * Save album
 *
 * @param array $data received post data
 * @return bool True on success, false on validation errors
 * @throws InternalErrorException
 */
	public function saveAlbum($data) {
		$this->begin();

		$this->set($data);
		if (!$this->validates()) {
			return false;
		}

		try {
			$doSaveDisplay = !$this->exists();
			if (!$album = $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			if ($doSaveDisplay) {
				$displayAlbum = ClassRegistry::init('PhotoAlbums.PhotoAlbumDisplayAlbum');
				$data = $displayAlbum->create();
				$data['PhotoAlbumDisplayAlbum']['frame_key'] = Current::read('Frame.key');
				$data['PhotoAlbumDisplayAlbum']['album_key'] = $album['PhotoAlbum']['key'];
				if (!$displayAlbum->save($data)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return $album;
	}
}
