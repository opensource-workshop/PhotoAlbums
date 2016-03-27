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
			if (!$album = $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		return $album;
	}
}
