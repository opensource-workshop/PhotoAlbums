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
App::uses('Current', 'NetCommons.Utility');
App::uses('UnZip', 'Files.Utility');
App::uses('File', 'Utility');
App::uses('SiteSettingUtil', 'SiteManager.Utility');

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
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$field = PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME;
		$validate = array();
		if (empty($this->data['UploadFile'])) {
			$validate['isFileUpload'] = array(
				'rule' => array('isFileUpload'),
				'message' => array(__d('files', 'Please specify the file'))
			);
		}

		if (strlen(Hash::get($this->data, 'PhotoAlbumPhoto.' . $field . '.name'))) {
			$validate['photoExtension'] = array(
				'rule' => array(
					'extension',
					array('gif', 'jpeg', 'png', 'jpg', 'zip')
				),
				'message' => array(__d('files', 'It is upload disabled file format'))
			);

			/*
			$validate['mimetype'] = array(
				'rule' => array('mimeType', array('???')),
				'message' => array(__d('files', 'It is upload disabled file format'))
			);
			*/
		}

		$this->validate = Hash::merge(
			$this->validate,
			array(
				$field => $validate
			)
		);

		return parent::beforeValidate($options);
	}

/**
 * Save photo
 *
 * @param array $data received post data
 * @return bool True on success, false on validation errors
 * @throws InternalErrorException
 */
	public function savePhoto($data) {
		$this->begin();

		$regenerateData = $this->__regenerateDataForZip($data);

		foreach ($regenerateData as $index => $data) {
			if ($index > 0) {
				$this->create();
			}

			$this->set($data);
			if (!$this->validates()) {
				$this->rollback();
				return false;
			}

			try {
				if (!$photo[] = $this->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}

				$this->commit();

			} catch (Exception $ex) {
				$this->rollback($ex);
			}
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
			/* 現状なし
			if ($this->hasField('public_type')) {
				$publicTypeConditions = $this->_getPublicTypeConditions($this);
				$activeConditions[] = $publicTypeConditions;
			}*/
			$latestConditons = array(
				$this->alias . '.is_latest' => true,
				$this->alias . '.created_user' => Current::read('User.id'),
			);
		} else {
			// 時限公開条件追加
			$activeConditions = array(
				$this->alias . '.is_active' => true,
			);
			/* 現状なし
			if ($this->hasField('public_type')) {
				$publicTypeConditions = $this->_getPublicTypeConditions($this);
				$activeConditions[] = $publicTypeConditions;
			}*/
			$latestConditons = array();
		}

		$langConditions = array(
			$this->alias . '.language_id' => Current::read('Language.id'),
		);

		$conditions = Hash::merge($langConditions, array(
			'OR' => array($activeConditions, $latestConditons)
		));

		return $conditions;
	}

/**
 * Regenerate data for zip
 *
 * @param array $data received post data
 * @return array
 * @throws InternalErrorException
 */
	private function __regenerateDataForZip($data) {
		$files = array();
		if ($data['PhotoAlbumPhoto']['photo']['type'] == 'application/x-zip-compressed') {
			$zip = new UnZip($data['PhotoAlbumPhoto']['photo']['tmp_name']);
			$unzipedFolder = $zip->extract();
			$dir = new Folder($unzipedFolder->path);
			$files = $dir->findRecursive('.*\.(jpg|jpeg)');
		}

		if (!$files) {
			return array($data);
		}

		foreach ($files as $file) {
			$file = new File($file);
			$data['PhotoAlbumPhoto']['photo'] = array_merge(
				$data['PhotoAlbumPhoto']['photo'],
				array(
					'name' => $file->name,
					'type' => $file->mime(),
					'tmp_name' => $file->path,
					'size' => $file->size()
				)
			);
			$regenerateData[] = $data;
		}

		return $regenerateData;
	}

}
