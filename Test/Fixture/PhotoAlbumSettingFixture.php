<?php
/**
 * PhotoAlbumSettingFixture
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for PhotoAlbumSettingFixture
 */
class PhotoAlbumSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'block_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'use_workflow' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
		'use_like' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
		'use_unlike' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
		'use_comment' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
		'use_comment_approval' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'block_key' => 'Lorem ipsum dolor sit amet',
			'use_workflow' => 1,
			'use_like' => 1,
			'use_unlike' => 1,
			'use_comment' => 1,
			'use_comment_approval' => 1,
			'room_id' => 1,
			'created_user' => 1,
			'created' => '2016-03-10 06:06:23',
			'modified_user' => 1,
			'modified' => '2016-03-10 06:06:23'
		),
	);

}
