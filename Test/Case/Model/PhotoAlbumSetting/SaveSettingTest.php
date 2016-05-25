<?php
/**
 * PhotoAlbumSettingSaveSetting Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumSetting', 'PhotoAlbums.Model');
App::uses('NetCommonsSaveTest', 'NetCommons.TestSuite');
App::uses('PhotoAlbumSettingFixture', 'PhotoAlbums.Test/Fixture');

/**
 * Summary for PhotoAlbumSettingSaveSetting Test Case
 */
class PhotoAlbumSettingSaveSettingTest extends NetCommonsSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_setting',
	);

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'PhotoAlbumSetting';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'savePhotoAlbumSetting';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		ClassRegistry::removeObject('PhotoAlbumSetting');
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
 * Save用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderSave() {
		$data['PhotoAlbumSetting'] = (new PhotoAlbumSettingFixture())->records[0];

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);
		// * 新規の登録処理
		$results[1] = array($data);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbumSetting.id', null);
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumSetting.created_user');
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumSetting.created');

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
			array($data, 'PhotoAlbums.PhotoAlbumSetting', 'save'),
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
			array($data, 'PhotoAlbums.PhotoAlbumSetting'),
		);
	}

}
