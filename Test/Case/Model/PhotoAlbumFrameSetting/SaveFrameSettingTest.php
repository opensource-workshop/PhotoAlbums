<?php
/**
 * PhotoAlbumFrameSettingSaveFrameSetting Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumFrameSetting', 'PhotoAlbums.Model');
App::uses('NetCommonsSaveTest', 'NetCommons.TestSuite');
App::uses('PhotoAlbumFrameSettingFixture', 'PhotoAlbums.Test/Fixture');

/**
 * Summary for PhotoAlbumFrameSettingSaveFrameSetting Test Case
 */
class PhotoAlbumFrameSettingSaveFrameSettingTest extends NetCommonsSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_frame_setting',
		'plugin.photo_albums.photo_album_display_album',
	);

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'PhotoAlbumFrameSetting';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'savePhotoAlbumFrameSetting';


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		ClassRegistry::removeObject('PhotoAlbumFrameSetting');
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
 * Save用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderSave() {
		$data['PhotoAlbumFrameSetting'] = (new PhotoAlbumFrameSettingFixture())->records[0];

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);
		// * 新規の登録処理
		$results[1] = array($data);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbumFrameSetting.id', null);
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumFrameSetting.created_user');
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumFrameSetting.created');

		return $results;
	}

/**
 * SaveのExceptionError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnExceptionError() {
		$data = $this->dataProviderSave()[0][0];

		return array(
			array($data, 'PhotoAlbums.PhotoAlbumFrameSetting', 'save'),
		);
	}

/**
 * SaveのValidationError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド(省略可：デフォルト validates)
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnValidationError() {
		$data = $this->dataProviderSave()[0][0];

		return array(
			array($data, 'PhotoAlbums.PhotoAlbumFrameSetting'),
		);
	}

}
