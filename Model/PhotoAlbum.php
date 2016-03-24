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
App::uses('WorkflowComponent', 'Workflow.Controller/Component');

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
		// いる？
		if (!isset($results[0][$this->alias]['key'])) {
			return $results;
		}

		$keyResults = array();
		foreach ($results as $result) {
			$albumKey = $result[$this->alias]['key'];

			$result[$this->alias]['photo_count'] = 0;
			$result[$this->alias]['published_photo_count'] = 0;
			$result[$this->alias]['approval_waiting_photo_count'] = 0;
			$result[$this->alias]['disapproved_photo_count'] = 0;

			$keyResults[$albumKey] = $result;
		}

		$Photo = ClassRegistry::init('PhotoAlbums.PhotoAlbumPhoto');
		$query = array(
			'conditions' => $Photo->getWorkflowConditions() + array(
				'PhotoAlbumPhoto.album_key' => array_keys($keyResults)
			),
			'fields' => array(
				'PhotoAlbumPhoto.album_key',
				'COUNT(PhotoAlbumPhoto.album_key) as PhotoAlbum__photo_count'
			),
			'recursive' => -1,
			'group' => array('PhotoAlbumPhoto.album_key'),
			'order' => array('PhotoAlbumPhoto.album_key' => 'asc')
		);

		$query['conditions']['status'] = WorkflowComponent::STATUS_PUBLISHED;
		$published = $Photo->find('all', $query);

		$query['conditions']['status'] = WorkflowComponent::STATUS_APPROVED;
		$approvalWaiting = $Photo->find('all', $query);

		$query['conditions']['status'] = WorkflowComponent::STATUS_DISAPPROVED;
		$disapproved = $Photo->find('all', $query);

		foreach ($published as $index => $publishedData) {
			$approvalWaitingData = $approvalWaiting[$index];
			$disapprovedData = $$disapproved[$index];
			$albumKey = $publishedData['PhotoAlbumPhoto']['album_key'];

			$keyResults[$albumKey][$this->alias]['published_photo_count'] = $publishedData['photo_count'];
			$keyResults[$albumKey][$this->alias]['photo_count'] += $publishedData['photo_count'];
			$keyResults[$albumKey][$this->alias]['approval_waiting_photo_count'] = $approvalWaitingData['photo_count'];
			$keyResults[$albumKey][$this->alias]['photo_count'] += $approvalWaitingData['photo_count'];
			$keyResults[$albumKey][$this->alias]['disapproved_photo_count'] = $disapprovedData['photo_count'];
			$keyResults[$albumKey][$this->alias]['photo_count'] += $disapprovedData['photo_count'];
		}

		$results = array_values($keyResults);
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
				$DisplayAlbum = ClassRegistry::init('PhotoAlbums.PhotoAlbumDisplayAlbum');
				$data = $DisplayAlbum->create();
				$data['PhotoAlbumDisplayAlbum']['frame_key'] = Current::read('Frame.key');
				$data['PhotoAlbumDisplayAlbum']['album_key'] = $album['PhotoAlbum']['key'];
				if (!$DisplayAlbum->save($data)) {
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
