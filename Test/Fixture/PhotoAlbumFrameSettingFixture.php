<?php
/**
 * PhotoAlbumFrameSettingFixture
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for PhotoAlbumFrameSettingFixture
 */
class PhotoAlbumFrameSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'display_type' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 2, 'unsigned' => false, 'comment' => '1:Multi album, 2:List of photo, 3: Slide show'),
		'albums_per_page' => array('type' => 'integer', 'null' => true, 'default' => '20', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'albums_sort_key' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumSetting.weght', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'albums_sort_value' => array('type' => 'string', 'null' => true, 'default' => 'DESC', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
		'photos_per_page' => array('type' => 'integer', 'null' => true, 'default' => '40', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'photos_sort_key' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumSetting.weght', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'photos_sort_value' => array('type' => 'string', 'null' => true, 'default' => 'DESC', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
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
			'frame_key' => 'Lorem ipsum dolor sit amet',
			'display_type' => 1,
			'albums_per_page' => 1,
			'albums_sort_key' => 'Lorem ipsum dolor sit amet',
			'albums_sort_value' => 'Lo',
			'photos_per_page' => 1,
			'photos_sort_key' => 'Lorem ipsum dolor sit amet',
			'photos_sort_value' => 'Lo',
			'created_user' => 1,
			'created' => '2016-03-10 06:07:14',
			'modified_user' => 1,
			'modified' => '2016-03-10 06:07:14'
		),
	);

}