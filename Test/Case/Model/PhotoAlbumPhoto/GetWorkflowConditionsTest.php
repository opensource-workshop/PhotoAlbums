<?php
/**
 * PhotoAlbumPhotoGetWorkflowConditions Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumPhoto', 'PhotoAlbums.Model');
App::uses('PhotoAlbumTestCurrentUtility', 'PhotoAlbums.Test/Case/Model');
App::uses('NetCommonsCakeTestCase', 'NetCommons.TestSuite');

/**
 * Summary for PhotoAlbumPhotoGetWorkflowConditions Test Case
 */
class PhotoAlbumPhotoGetWorkflowConditionsTest extends NetCommonsCakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_photo',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
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
 * getWorkflowConditions test case of has content_editable
 *
 * @return void
 */
	public function testHasContentEditable() {
		$currentValue['Permission']['content_editable']['value'] = true;
		$currentValue['Language']['id'] = 99;
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$expected = array (
			'PhotoAlbumPhoto.language_id' => 99,
			'OR' => array(
				array (),
				array ('PhotoAlbumPhoto.is_latest' => true),
			)
		);
		$actual = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$this->assertEquals($expected, $actual);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}

/**
 * getWorkflowConditions test case of has photo_creatable
 *
 * @return void
 */
	public function testHasPhotoCreatable() {
		$currentValue['Permission']['content_editable']['value'] = false;
		$currentValue['Permission']['photo_albums_photo_creatable']['value'] = true;
		$currentValue['Language']['id'] = 99;
		$currentValue['User']['id'] = 88;
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$expected = array (
			'PhotoAlbumPhoto.language_id' => 99,
			'OR' => array(
				array (
					'PhotoAlbumPhoto.is_active' => true,
					'PhotoAlbumPhoto.created_user !=' => 88
				),
				array (
					'PhotoAlbumPhoto.is_latest' => true,
					'PhotoAlbumPhoto.created_user' => 88
				)
			)
		);
		$actual = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$this->assertEquals($expected, $actual);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}

/**
 * getWorkflowConditions test case of not has photo_creatable
 *
 * @return void
 */
	public function testNotHasPhotoCreatable() {
		$currentValue['Permission']['content_editable']['value'] = false;
		$currentValue['Permission']['photo_albums_photo_creatable']['value'] = false;
		$currentValue['Language']['id'] = 99;
		$currentValue['User']['id'] = 88;
		PhotoAlbumTestCurrentUtility::setValue($currentValue);

		$expected = array (
			'PhotoAlbumPhoto.language_id' => 99,
			'OR' => array(
				array (
					'PhotoAlbumPhoto.is_active' => true,
				),
				array ()
			)
		);
		$actual = $this->PhotoAlbumPhoto->getWorkflowConditions();
		$this->assertEquals($expected, $actual);

		PhotoAlbumTestCurrentUtility::setOriginValue();
	}
}
