<?php
/**
 * PhotoAlbumPhoto Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');

/**
 * Summary for PhotoAlbumPhoto Model
 */
class PhotoAlbumPhoto extends PhotoAlbumsAppModel {

/**
 * Field name for attachment behavior
 *
 * @var int
 */
	const ATTACHMENT_FIELD_NAME = 'photo';

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
		'Files.Attachment' => [PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME],
		'Workflow.Workflow',
		'Workflow.WorkflowComment',
	);

/**
 * Save photo
 *
 * @param array $data received post data
 * @return bool True on success, false on validation errors
 * @throws InternalErrorException
 */
	public function savePhoto($data) {
		$this->begin();

		$this->set($data);
		if (!$this->validates()) {
			return false;
		}

		try {
			if (!$photo = $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return $photo;
	}

/**
 * Publish photo
 *
 * @param array $data photo data for publish
 * @return bool True on success, false on validation errors
 * @throws InternalErrorException
 */
	public function publish($data) {
		$this->begin();

		foreach ($data as $photo) {
			unset($photo['PhotoAlbumPhoto']['id']);
			$photo['PhotoAlbumPhoto']['status'] = WorkflowComponent::STATUS_PUBLISHED;

			$this->create($photo);
			if (!$this->validates()) {
				return false;
			}

			try {
				if (!$this->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			} catch (Exception $ex) {
				$this->rollback($ex);
			}
		}

		$this->commit();

		return true;
	}

/**
 * Delete photo
 *
 * @param array $data delete data
 * @return bool True on success
 * @throws InternalErrorException
 */
	public function deletePhoto($data) {
		$this->begin();

		try {
			if (!$this->deleteAll(array('PhotoAlbumPhoto.key' => $data['PhotoAlbumPhoto']['key']), false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->deleteCommentsByContentKey($data['PhotoAlbumPhoto']['key']);

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return true;
	}

/**
 * Get workflow conditions
 *
 * @return array Conditions data
 */
	public function getWorkflowConditions() {
		if (Current::permission('content_editable')) {
			$activeConditions = array();
			$latestConditons = array(
				$this->alias . '.is_latest' => true,
			);
		} elseif (Current::permission('photo_albums_photo_creatable')) {
			$activeConditions = array(
				$this->alias . '.is_active' => true,
				$this->alias . '.created_user !=' => Current::read('User.id'),
			);
			// 時限公開条件追加
			if ($this->hasField('public_type')) {
				$publicTypeConditions = $this->_getPublicTypeConditions($this);
				$activeConditions[] = $publicTypeConditions;
			}
			$latestConditons = array(
				$this->alias . '.is_latest' => true,
				$this->alias . '.created_user' => Current::read('User.id'),
			);
		} else {
			// 時限公開条件追加
			$activeConditions = array(
				$this->alias . '.is_active' => true,
			);
			if ($this->hasField('public_type')) {
				$publicTypeConditions = $this->_getPublicTypeConditions($this);
				$activeConditions[] = $publicTypeConditions;
			}
			$latestConditons = array();
		}

		if ($this->hasField('language_id')) {
			$langConditions = array(
				$this->alias . '.language_id' => Current::read('Language.id'),
			);
		} else {
			$langConditions = array();
		}
		$conditions = Hash::merge($langConditions, array(
			'OR' => array($activeConditions, $latestConditons)
		));

		return $conditions;
	}
}
