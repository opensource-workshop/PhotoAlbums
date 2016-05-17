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
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
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

		$Photo = ClassRegistry::init('PhotoAlbums.PhotoAlbumPhoto');
		$Photo->virtualFields = array('photo_count' => 0);
		$query = array(
			'conditions' => $Photo->getWorkflowConditions() + array(
				'PhotoAlbumPhoto.album_key' => Hash::extract($results, '{n}.PhotoAlbum.key')
			),
			'fields' => array(
				'PhotoAlbumPhoto.album_key',
				'PhotoAlbumPhoto.status',
				'COUNT(PhotoAlbumPhoto.album_key) as PhotoAlbumPhoto__photo_count'
			),
			'recursive' => -1,
			'group' => array(
				'PhotoAlbumPhoto.album_key',
				'PhotoAlbumPhoto.status',
			),
		);
		// ＴＯＤＯ listでいける？
		$photoCount = $Photo->find('all', $query);
		$photoCount = Hash::combine(
			$photoCount,
			'{n}.PhotoAlbumPhoto.status',
			'{n}.PhotoAlbumPhoto.photo_count',
			'{n}.PhotoAlbumPhoto.album_key'
		);

		foreach ($results as $index => $result) {
			$albumKey = $result[$this->alias]['key'];

			$publishedCount = Hash::get(
				$photoCount,
				[$albumKey, WorkflowComponent::STATUS_PUBLISHED],
				0
			);
			$pendingCount = Hash::get(
				$photoCount,
				[$albumKey, WorkflowComponent::STATUS_APPROVED],
				0
			);
			$draftCount = Hash::get(
				$photoCount,
				[$albumKey, WorkflowComponent::STATUS_IN_DRAFT],
				0
			);
			$disapprovedCount = Hash::get(
				$photoCount,
				[$albumKey, WorkflowComponent::STATUS_DISAPPROVED],
				0
			);
			$results[$index][$this->alias] += array(
				'published_photo_count' => $publishedCount,
				'pending_photo_count' => $pendingCount,
				'draft_photo_count' => $draftCount,
				'disapproved_photo_count' => $disapprovedCount,
				'photo_count' => $publishedCount +
					$pendingCount +
					$draftCount +
					$disapprovedCount,
			);
		}

		return $results;
	}

/**
 * Save album
 *
 * @param array $data received post data
 * @return mixed On success Model::$data, false on validation errors
 * @throws InternalErrorException
 */
	public function saveAlbum($data) {
		$this->begin();

		$this->set($data);
		if (!$this->validates()) {
			return false;
		}

		try {
			if (!$album = $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return $album;
	}

/**
 * Save album with display data
 *
 * @param array $data received post data
 * @return mixed On success Model::$data, false on validation errors
 * @throws InternalErrorException
 */
	public function saveAlbumWithDisplay($data) {
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

/**
 * Delete album
 *
 * @param array $data delete data
 * @return bool True on success
 * @throws InternalErrorException
 */
	public function deleteAlbum($data) {
		$this->begin();

		try {
			if (!$this->deleteAll(array('PhotoAlbum.key' => $data['PhotoAlbum']['key']), false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$Photo = ClassRegistry::init('PhotoAlbums.PhotoAlbumPhoto');
			$conditions = array('PhotoAlbumPhoto.album_key' => $data['PhotoAlbum']['key']);
			$query = array(
				'fields' => array('PhotoAlbumPhoto.key'),
				'conditions' => $conditions,
				'recursive' => -1
			);
			$contentKeys = $Photo->find('list', $query);
			if (!$Photo->deleteAll($conditions, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$DisplayAlbum = ClassRegistry::init('PhotoAlbums.PhotoAlbumDisplayAlbum');
			$conditions = array('PhotoAlbumDisplayAlbum.album_key' => $data['PhotoAlbum']['key']);
			if (!$DisplayAlbum->deleteAll($conditions, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$contentKeys[] = $data['PhotoAlbum']['key'];
			$this->deleteCommentsByContentKey($contentKeys);

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return true;
	}
}
