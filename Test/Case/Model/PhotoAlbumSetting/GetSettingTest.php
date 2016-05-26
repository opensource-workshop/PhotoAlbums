<?php
/**
 * PhotoAlbumSettingGetSetting Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumSetting', 'PhotoAlbums.Model');
App::uses('PhotoAlbumTestCurrentUtility', 'PhotoAlbums.Test/Case/Model');

/**
 * Summary for PhotoAlbumSettingGetSetting Test Case
 */
class PhotoAlbumSettingGetSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_setting',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumSetting');
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

/**
 * getFrameSetting test
 *
 * @return void
 */
	public function testGetSetting() {
		$currentValue['Block']['key'] = 'Lorem ipsum dolor sit amet';
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$expected = (new PhotoAlbumSettingFixture())->records[0];
		$actual = $this->PhotoAlbumSetting->getSetting();
		$this->assertEquals($expected, $actual['PhotoAlbumSetting']);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}

/**
 * getFrameSettingNotFound test
 *
 * @return void
 */
	public function testGetFrameSettingNotFound() {
		$actual = $this->PhotoAlbumSetting->getSetting();

		$this->assertArrayHasKey('PhotoAlbumSetting', $actual);
		$this->assertArrayNotHasKey('id', $actual['PhotoAlbumSetting']);
	}
}
