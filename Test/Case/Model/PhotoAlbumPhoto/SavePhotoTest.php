<?php
/**
 * PhotoAlbumSavePhoto Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');
App::uses('WorkflowSaveTest', 'Workflow.TestSuite');
App::uses('PhotoAlbumPhotoFixture', 'PhotoAlbums.Test/Fixture');
App::uses('TemporaryFolder', 'Files.Utility');
App::uses('Security', 'Utility');

/**
 * Summary for PhotoAlbumSavePhoto Test Case
 */
class PhotoAlbumSavePhotoTest extends WorkflowSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_photo',
		'plugin.site_manager.site_setting',	// For Files plugin
	);

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'PhotoAlbumPhoto';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'savePhoto';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		ClassRegistry::removeObject('PhotoAlbumPhoto');
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
 * Save用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderSave() {
		$path = CakePlugin::path('PhotoAlbums') . DS .
			WEBROOT_DIR . DS .
			Configure::read('App.imageBaseUrl') .
			'noimage.jpg';
		$Folder = new TemporaryFolder();
		copy($path, $Folder->path . DS . 'editTest.jpg');
		$field = PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME;

		$data['PhotoAlbumPhoto'] = (new PhotoAlbumPhotoFixture())->records[0];
		$data['PhotoAlbumPhoto'][$field]['name'] = 'editTest.jpg';
		$data['PhotoAlbumPhoto'][$field]['type'] = 'image/jpeg';
		$data['PhotoAlbumPhoto'][$field]['size'] = filesize($path);
		$data['PhotoAlbumPhoto'][$field]['tmp_name'] = $Folder->path . DS . 'editTest.jpg';

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);
		// * 新規の登録処理
		copy($path, $Folder->path . DS . 'createTest.jpg');
		$data['PhotoAlbumPhoto'][$field]['name'] = 'createTest.jpg';
		$data['PhotoAlbumPhoto'][$field]['tmp_name'] = $Folder->path . DS . 'createTest.jpg';
		$results[1] = array($data);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbumPhoto.id', null);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbumPhoto.key', null);
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumPhoto.created_user');
		$results[1] = Hash::remove($results[1], '0.PhotoAlbumPhoto.created');

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
			array($data, 'PhotoAlbums.PhotoAlbumPhoto', 'save'),
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
			array($data, 'PhotoAlbums.PhotoAlbumPhoto'),
		);
	}

/**
 * savePhoto test
 *
 * @param array $data 登録データ
 * @dataProvider dataProviderSave
 * @return void
 */
	public function testSave($data) {
		$model = $this->_modelName;
		$method = $this->_methodName;

		$result = $this->$model->$method($data);
		$this->assertNotEmpty($result);
	}

}
