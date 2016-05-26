<?php
/**
 * PhotoAlbumDeleteAlbumTest Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbum', 'PhotoAlbums.Model');
App::uses('WorkflowDeleteTest', 'Workflow.TestSuite');
App::uses('PhotoAlbumFixture', 'PhotoAlbums.Test/Fixture');

/**
 * Summary for PhotoAlbumDeleteAlbumTest Test Case
 */
class PhotoAlbumDeleteAlbumTest extends WorkflowDeleteTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album',
		'plugin.photo_albums.photo_album_photo',
		'plugin.photo_albums.photo_album_display_album',
		'plugin.site_manager.site_setting',	// For Files plugin
		//'plugin.files.upload_file',
		//'plugin.files.upload_files_content',
		'plugin.workflow.workflow_comment',
		//'plugin.users.user',
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
	protected $_methodName = 'deleteAlbum';

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
 * Delete用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderDelete() {
		$data['PhotoAlbum'] = (new PhotoAlbumFixture())->records[0];
		$results[0] = array($data);

		return $results;
	}

/**
 * DeleteのExceptionError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド
 *
 * @return array テストデータ
 */
	public function dataProviderDeleteOnExceptionError() {
		$data = $this->dataProviderDelete()[0][0];

		return array(
			array($data, 'PhotoAlbums.PhotoAlbum', 'deleteAll'),
			array($data, 'PhotoAlbums.PhotoAlbumPhoto', 'deleteAll'),
			array($data, 'PhotoAlbums.PhotoAlbumDisplayAlbum', 'deleteAll'),
		);
	}

}
