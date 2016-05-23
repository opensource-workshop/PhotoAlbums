<?php
/**
 * PhotoAlbumFrameSetting Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumFrameSetting', 'Model');

/**
 * Summary for PhotoAlbumFrameSetting Test Case
 */
class PhotoAlbumFrameSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		/*
		'app.photo_album_frame_setting',
		'app.user',
		'app.role',
		'app.language',
		'app.plugin',
		'app.plugins_role',
		'app.room',
		'app.space',
		'app.rooms_language',
		'app.roles_room',
		'app.block_role_permission',
		'app.room_role_permission',
		'app.roles_rooms_user',
		'app.user_role_setting',
		'app.users_language'
		*/
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumFrameSetting = ClassRegistry::init('PhotoAlbumFrameSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbumFrameSetting);

		parent::tearDown();
	}

/**
 * Dummy test
 *
 * @return void
 */
	public function test() {
		$this->assertTrue(true);
	}
}
