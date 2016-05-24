<?php
/**
 * PhotoAlbumDisplayAlbum Test Case
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('PhotoAlbumDisplayAlbum', 'PhotoAlbums.Model');


/**
 * Summary for PhotoAlbumDisplayAlbum Test Case
 */
class PhotoAlbumDisplayAlbumTest extends NetCommonsModelTestCase {
//class PhotoAlbumDisplayAlbumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.photo_albums.photo_album_display_album',
	);

/**
 * Current reflection object
 *
 * @var array
 */
	private $__currentProperty = null;

/**
 * Current object value
 *
 * @var array
 */
	private $__currentValue = array();

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoAlbumDisplayAlbum = ClassRegistry::init('PhotoAlbums.PhotoAlbumDisplayAlbum');

		$this->__currentProperty = new ReflectionProperty('Current', 'current');
		$this->__currentProperty->setAccessible(true);
		$this->__currentValue = $this->__currentProperty->getValue();

		$currentValue['Frame']['key'] = 'Lorem ipsum dolor sit amet';
		$this->__currentProperty->setValue($currentValue);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoAlbumDisplayAlbum);
		$this->__currentProperty->setValue($this->__currentValue);

		parent::tearDown();
	}

/**
 * getDisplayList method test
 *
 * @return void
 */
	public function testGetDisplayList() {
		$expected = $this->PhotoAlbumDisplayAlbum->getDisplayList();
		$actual[1] = 'Lorem ipsum dolor sit amet';

		$this->assertEquals($expected, $actual);
	}
}
