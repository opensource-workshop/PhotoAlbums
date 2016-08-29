<?php
/**
 * PhotoAlbumSaveZipFile Test Case
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
 * Summary for PhotoAlbumSaveZipFile Test Case
 */
class PhotoAlbumSaveZipFileTest extends WorkflowSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_photo',
		'plugin.site_manager.site_setting',	// For Files plugin
		'plugin.workflow.workflow_comment',
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
		$path = CakePlugin::path('PhotoAlbums') .
			'Test' . DS . 'Fixture' . DS . 'test.zip';
		$Folder = new TemporaryFolder();
		copy($path, $Folder->path . DS . 'test.zip');
		$field = PhotoAlbumPhoto::ATTACHMENT_FIELD_NAME;

		$data['PhotoAlbumPhoto'] = (new PhotoAlbumPhotoFixture())->records[0];
		$data['PhotoAlbumPhoto'][$field]['name'] = 'test.zip';
		$data['PhotoAlbumPhoto'][$field]['type'] = 'application/x-zip-compressed';
		$data['PhotoAlbumPhoto'][$field]['size'] = filesize($path);
		$data['PhotoAlbumPhoto'][$field]['tmp_name'] = $Folder->path . DS . 'test.zip';
		$data['PhotoAlbumPhoto'][$field]['error'] = UPLOAD_ERR_OK;

		// * 編集の登録処理
		$results[0] = array($data);

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
		$data['UploadFile'] = array('photo' => 'dummy');

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

/**
 * Test to call WorkflowBehavior::beforeSave
 *
 * WorkflowBehaviorをモックに置き換えて登録処理を呼び出します。<br>
 * WorkflowBehavior::beforeSaveが1回呼び出されることをテストします。<br>
 * ##### 参考URL
 * http://stackoverflow.com/questions/19833495/how-to-mock-a-cakephp-behavior-for-unit-testing]
 *
 * @param array $data 登録データ
 * @dataProvider dataProviderSave
 * @return void
 * @throws CakeException Workflow.Workflowがロードされていないとエラー
 */
	public function testCallWorkflowBehavior($data) {
		$model = $this->_modelName;
		$method = $this->_methodName;

		if (! $this->$model->Behaviors->loaded('Workflow.Workflow')) {
			$error = '"Workflow.Workflow" not loaded in ' . $this->$model->alias . '.';
			throw new CakeException($error);
		};

		ClassRegistry::removeObject('WorkflowBehavior');
		$workflowBehaviorMock = $this->getMock('WorkflowBehavior', ['beforeSave']);
		ClassRegistry::addObject('WorkflowBehavior', $workflowBehaviorMock);
		$this->$model->Behaviors->unload('Workflow');
		$this->$model->Behaviors->load('Workflow', $this->$model->actsAs['Workflow.Workflow']);

		$workflowBehaviorMock
			->expects($this->exactly(2))
			->method('beforeSave')
			->will($this->returnValue(true));

		$this->$model->$method($data);
	}
}
