<?php
/**
 * PhotoAlbumPhoto Test Case
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');

/**
 * Summary for PhotoAlbumPhoto Test Case
 */
class PhotoAlbumPhotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_photo',
		'plugin.photo_albums.block',
		'plugin.photo_albums.user',
		'plugin.photo_albums.role',
		'plugin.photo_albums.language',
		'plugin.photo_albums.plugin',
		'plugin.photo_albums.plugins_role',
		'plugin.photo_albums.room',
		'plugin.photo_albums.space',
		'plugin.photo_albums.rooms_language',
		'plugin.photo_albums.roles_room',
		'plugin.photo_albums.block_role_permission',
		'plugin.photo_albums.room_role_permission',
		'plugin.photo_albums.roles_rooms_user',
		'plugin.photo_albums.user_role_setting',
		'plugin.photo_albums.users_language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumPhoto = ClassRegistry::init('PhotoAlbums.PhotoAlbumPhoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbumPhoto);

		parent::tearDown();
	}

}
