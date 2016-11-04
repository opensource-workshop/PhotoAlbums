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
App::uses('Current', 'NetCommons.Utility');

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
		'plugin.photo_albums.block_setting_for_photo_album',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		Current::write('Plugin.key', 'photo_albums');
		Current::write('Block.key', 'block_1');
		Current::write('Room.need_approval', '1'); // ルーム承認する
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
		$currentValue['Block']['key'] = 'block_1';
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$expected = array(
			'use_workflow' => '1',
			'use_like' => '1',
			'use_unlike' => '1',
			'use_comment' => '1',
			'use_comment_approval' => '1',
		);
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
	}
}
