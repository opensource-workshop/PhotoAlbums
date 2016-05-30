<?php
/**
 * PhotoAlbumPhotoPublish Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');
App::uses('PhotoAlbumTestCurrentUtility', 'PhotoAlbums.Test/Case/Model');

/**
 * Summary for PhotoAlbumPhotoPublish Test Case
 */
class PhotoAlbumPhotoPublishTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_photo',
		'plugin.site_manager.site_setting',	// For Files plugin
		'plugin.users.user',
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

/**
 * publish test
 *
 * @return void
 */
	public function testPublish() {
		$currentValue['Permission']['content_publishable']['value'] = true;
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$data['PhotoAlbumPhoto']['id'] = 1;
		$actual = $this->PhotoAlbumPhoto->publish($data);
		$this->assertTrue($actual);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}

/**
 * publish test case of no permission
 *
 * @return void
 */
	public function testPublishNoPermission() {
		$data['PhotoAlbumPhoto']['id'] = 1;
		$actual = $this->PhotoAlbumPhoto->publish($data);
		$this->assertFalse($actual);
	}

/**
 * publish test case of exception
 *
 * @return void
 */
	public function testPublishException() {
		$MockPhotoAlbumPhoto = $this->getMockForModel('PhotoAlbums.PhotoAlbumPhoto', ['save']);
		$MockPhotoAlbumPhoto
			->expects($this->once())
			->method('save')
			->will($this->returnValue(false));

		$currentValue['Permission']['content_publishable']['value'] = true;
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$this->setExpectedException('InternalErrorException');
		$data['PhotoAlbumPhoto']['id'] = 1;
		$MockPhotoAlbumPhoto->publish($data);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}

}
