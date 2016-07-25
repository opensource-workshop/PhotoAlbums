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
		'plugin.photo_albums.block_setting_for_photo_album',
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

		Current::write('Plugin.key', 'photo_albums');
		Current::write('Block.key', 'block_1');
		Current::write('Room.need_approval', '1'); // ルーム承認する
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
		$data['PhotoAlbumSetting'] = array(
			'use_workflow' => 1,
			'use_like' => 1,
			'use_unlike' => 1,
			'use_comment' => 1,
			'use_comment_approval' => 1,
		);

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);

		return $results;
	}

/**
 * Saveのテスト
 *
 * @param array $data 登録データ
 * @dataProvider dataProviderSave
 * @return void
 */
	public function testSave($data) {
		$model = $this->_modelName;
		$method = $this->_methodName;

		//テスト実行
		$result = $this->$model->$method($data);
		$this->assertNotEmpty($result);

		//登録データ取得
		$actual = $this->$model->getSetting();
		$expected = $data;

		$this->assertEquals($expected, $actual);
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
			array($data[$this->_modelName], 'Blocks.BlockSetting', 'saveMany'),
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
