<?php
/**
 * PhotoAlbumFrameSettingFixture
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
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
		'display_type' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'unsigned' => false, 'comment' => '1:List of album, 2:List of photo, 3: Slide show'),
		'albums_per_page' => array('type' => 'integer', 'null' => true, 'default' => '20', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'albums_order' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbum.modified desc', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'albums_sort' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbum.modified', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'albums_direction' => array('type' => 'string', 'null' => true, 'default' => 'desc', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
		'photos_per_page' => array('type' => 'integer', 'null' => true, 'default' => '50', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'photos_order' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumPhoto.modified desc', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'photos_sort' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumPhoto.modified', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'photos_direction' => array('type' => 'string', 'null' => true, 'default' => 'desc', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
		'slide_height' => array('type' => 'integer', 'null' => true, 'default' => '400', 'unsigned' => false, 'comment' => 'Slide show height'),
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
			'albums_order' => 'PhotoAlbum.modified desc',
			'albums_sort' => 'PhotoAlbum.modified',
			'albums_direction' => 'desc',
			'photos_per_page' => 1,
			'photos_order' => 'PhotoAlbumPhoto.modified desc',
			'photos_sort' => 'PhotoAlbumPhoto.modified',
			'photos_direction' => 'desc',
			'slide_height' => 1,
			'created_user' => 1,
			'created' => '2016-05-25 01:34:38',
			'modified_user' => 1,
			'modified' => '2016-05-25 01:34:38'
		),
		array(
			'id' => 3,
			'frame_key' => 'frame_3',
			'display_type' => 1,
			'albums_per_page' => 1,
			'albums_order' => 'PhotoAlbum.modified desc',
			'albums_sort' => 'PhotoAlbum.modified',
			'albums_direction' => 'desc',
			'photos_per_page' => 1,
			'photos_order' => 'PhotoAlbumPhoto.modified desc',
			'photos_sort' => 'PhotoAlbumPhoto.modified',
			'photos_direction' => 'desc',
			'slide_height' => 1,
			'created_user' => 1,
			'created' => '2016-05-25 01:34:38',
			'modified_user' => 1,
			'modified' => '2016-05-25 01:34:38'
		),
	);

}
