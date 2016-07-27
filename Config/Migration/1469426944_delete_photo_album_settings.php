<?php
/**
 * DeletePhotoAlbumSettings migration
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * DeletePhotoAlbumSettings migration
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @package NetCommons\PhotoAlbums\Config\Migration
 */
class DeletePhotoAlbumSettings extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'delete_photo_album_settings';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'drop_table' => array(
				'photo_album_settings'
			),
		),
		'down' => array(
			'create_table' => array(
				'photo_album_settings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID |  |  | '),
					'block_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'use_workflow' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
					'use_like' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
					'use_unlike' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
					'use_comment' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
					'use_comment_approval' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
					'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
