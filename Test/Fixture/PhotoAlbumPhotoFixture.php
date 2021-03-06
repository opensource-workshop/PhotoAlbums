<?php
/**
 * PhotoAlbumPhotoFixture
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for PhotoAlbumPhotoFixture
 */
class PhotoAlbumPhotoFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'block_id' => 1,
			'album_key' => 'Lorem ipsum dolor sit amet',
			'weight' => 1,
			'key' => 'Lorem ipsum dolor sit amet',
			'language_id' => 1,
			'status' => '1',
			'is_active' => 0,
			'is_latest' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created_user' => 1,
			'created' => '2016-05-25 02:20:52',
			'modified_user' => 1,
			'modified' => '2016-05-25 02:20:52'
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
