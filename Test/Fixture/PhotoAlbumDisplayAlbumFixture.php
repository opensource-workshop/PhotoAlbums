<?php
/**
 * PhotoAlbumDisplayAlbumFixture
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for PhotoAlbumDisplayAlbumFixture
 */
class PhotoAlbumDisplayAlbumFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'frame_key' => 'Lorem ipsum dolor sit amet',
			'album_key' => 'Lorem ipsum dolor sit amet',
			'created_user' => 1,
			'created' => '2016-05-25 01:33:08',
			'modified_user' => 1,
			'modified' => '2016-05-25 01:33:08'
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
