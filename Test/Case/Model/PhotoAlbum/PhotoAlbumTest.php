<?php
/**
 * PhotoAlbum Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbum', 'Model');

/**
 * Summary for PhotoAlbum Test Case
 */
class PhotoAlbumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		/*
		'app.photo_album',
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
		$this->PhotoAlbum = ClassRegistry::init('PhotoAlbum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbum);

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
