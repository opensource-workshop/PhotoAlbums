<?php
/**
 * PhotoAlbumFrameSettingGetFrameSetting Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumFrameSetting', 'PhotoAlbums.Model');
App::uses('PhotoAlbumTestCurrentUtil', 'PhotoAlbums.Test/Case/Model');

/**
 * Summary for PhotoAlbumFrameSettingGetFrameSetting Test Case
 */
class PhotoAlbumFrameSettingGetFrameSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_frame_setting',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumFrameSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumFrameSetting');
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
 * getFrameSetting test
 *
 * @return void
 */
	public function testGetFrameSetting() {
		$currentValue['Frame']['key'] = 'Lorem ipsum dolor sit amet';
		PhotoAlbumTestCurrentUtil::setValue($currentValue);

		$expected = (new PhotoAlbumFrameSettingFixture())->records[0];
		$actual = $this->PhotoAlbumFrameSetting->getFrameSetting();
		$this->assertEquals($expected, $actual['PhotoAlbumFrameSetting']);

		PhotoAlbumTestCurrentUtil::setOriginValue();
	}

/**
 * getFrameSettingNotFound test
 *
 * @return void
 */
	public function testGetFrameSettingNotFound() {
		$actual = $this->PhotoAlbumFrameSetting->getFrameSetting();

		$this->assertArrayHasKey('PhotoAlbumFrameSetting', $actual);
		$this->assertArrayNotHasKey('id', $actual['PhotoAlbumFrameSetting']);
	}
}
