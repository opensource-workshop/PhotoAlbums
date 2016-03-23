<?php
/**
 * PhotoAlbumSetting Test Case
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumSetting', 'Model');

/**
 * Summary for PhotoAlbumSetting Test Case
 */
class PhotoAlbumSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.photo_album_setting',
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
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumSetting = ClassRegistry::init('PhotoAlbumSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbumSetting);

		parent::tearDown();
	}

}