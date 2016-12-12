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

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		require_once App::pluginPath('PhotoAlbums') . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$this->fields = (new PhotoAlbumsSchema())->tables[Inflector::tableize($this->name)];
		parent::init();
	}

}
