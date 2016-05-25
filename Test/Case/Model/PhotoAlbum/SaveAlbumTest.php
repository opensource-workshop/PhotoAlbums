<?php
/**
 * PhotoAlbumSaveAlbum Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbum', 'PhotoAlbums.Model');
App::uses('WorkflowSaveTest', 'Workflow.TestSuite');
App::uses('PhotoAlbumFixture', 'PhotoAlbums.Test/Fixture');

/**
 * Summary for PhotoAlbumSaveAlbum Test Case
 */
class PhotoAlbumSaveAlbumTest extends WorkflowSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album',
		'plugin.photo_albums.photo_album_photo',
	);

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'PhotoAlbum';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'saveAlbum';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		ClassRegistry::removeObject('PhotoAlbum');
		$this->PhotoAlbum = ClassRegistry::init('PhotoAlbums.PhotoAlbum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbum);

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
		$data['PhotoAlbum'] = (new PhotoAlbumFixture())->records[0];
		$data['PhotoAlbum']['published_photo_count'] = 0;
		$data['PhotoAlbum']['pending_photo_count'] = 0;
		$data['PhotoAlbum']['draft_photo_count'] = 0;
		$data['PhotoAlbum']['disapproved_photo_count'] = 0;
		$data['PhotoAlbum']['photo_count'] = 0;

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);
		// * 新規の登録処理
		$results[1] = array($data);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbum.id', null);
		$results[1] = Hash::insert($results[1], '0.PhotoAlbum.key', null);
		$results[1] = Hash::remove($results[1], '0.PhotoAlbum.created_user');
		$results[1] = Hash::remove($results[1], '0.PhotoAlbum.created');

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
			array($data, 'PhotoAlbums.PhotoAlbum', 'save'),
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
			array($data, 'PhotoAlbums.PhotoAlbum'),
		);
	}

}
